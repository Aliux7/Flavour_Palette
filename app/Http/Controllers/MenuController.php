<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\category;
use App\Models\Catering;
use App\Models\Menu;
use App\Models\menu_category;
use App\Models\menu_week_detail;
use App\Models\Order_header;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{

    private function countPrice(){
        $total_price = null;
        if(Auth::user()){
            if(Auth::user()->role == "seller"){
                $catering = User::find(Auth::user()->id)->catering;
                $order_header = Order_header::distinct()
                                ->select('order_headers.*')
                                ->join('order_details', 'order_details.order_id', '=', 'order_headers.id')
                                ->join('users', 'users.id', '=', 'order_headers.user_id')
                                ->join('menus', 'menus.id', '=', 'order_details.menu_id')
                                ->join('caterings', 'caterings.id', '=', 'menus.catering_id')
                                ->where('menus.catering_id', $catering->id)
                                ->where('order_details.status', 'LIKE', 'In Delivery')
                                ->get();

                foreach($order_header as $oh){
                    $total_price += $oh->total_price;
                }
            }
        }

        return $total_price;
    }

    public function home(Request $request){
        $menus = Menu::where('status', 'available')->get();
        // $popular_menus = Menu::join('order_details', 'menus.id', '=', 'order_details.menu_id')
        //                         ->select('menus.*')
        //                         ->groupBy('menus.id')
        //                         ->orderByDesc('COUNT(order_details.menu_id)')
        //                         ->take(5)
        //                         ->get();

        if($request->input('deactivate')){
            $userID = Auth::id();
            $user = User::find($userID);
            $user->status = 'inactive';
            $user->save();
        }else if($request->input('activate')){
            $userID = Auth::id();
            $user = User::find($userID);
            $user->status = 'active';
            $user->save();
        }

        session(['total_price' => $this->countPrice()]);

        return view('ViewPage.home_page', compact('menus'));
    }

    private function sorting($sort_by, $menus, $selected_date){
        if($sort_by){
            switch($sort_by){
                case "highest_rating":{
                    $menus = Menu::select('menus.id','menus.profile_menu','menus.catering_id','menus.name','menus.status','menus.price','menus.ordered','menus.description', DB::raw('(SUM(reviews.rating) / COUNT(reviews.rating))'))
                                    ->join('menu_week_details', 'menus.id', '=', 'menu_week_details.menu_id')
                                    ->join('reviews', 'menus.id', '=', 'reviews.menu_id')
                                    ->where('status', 'available')
                                    ->where('available_date', $selected_date)
                                    ->groupBy('menus.id','menus.profile_menu','menus.catering_id','menus.name','menus.status','menus.price','menus.ordered','menus.description')
                                    ->orderByRaw('(SUM(reviews.rating) / COUNT(reviews.rating)) DESC')
                                    ->paginate(50);
                    break;
                }
                case "lowest_price":{
                    $menus = Menu::select('menus.id','menus.profile_menu','menus.catering_id','menus.name','menus.status','menus.price','menus.ordered','menus.description', DB::raw('(SUM(reviews.rating) / COUNT(reviews.rating))'))
                                    ->join('menu_week_details', 'menus.id', '=', 'menu_week_details.menu_id')
                                    ->join('reviews', 'menus.id', '=', 'reviews.menu_id')
                                    ->where('status', 'available')
                                    ->where('available_date', $selected_date)
                                    ->groupBy('menus.id','menus.profile_menu','menus.catering_id','menus.name','menus.status','menus.price','menus.ordered','menus.description')
                                    ->orderByRaw('menus.price ASC')
                                    ->paginate(50);
                    break;
                }
                case "highest_price":{
                    $menus = Menu::select('menus.id','menus.profile_menu','menus.catering_id','menus.name','menus.status','menus.price','menus.ordered','menus.description', DB::raw('(SUM(reviews.rating) / COUNT(reviews.rating))'))
                                    ->join('menu_week_details', 'menus.id', '=', 'menu_week_details.menu_id')
                                    ->join('reviews', 'menus.id', '=', 'reviews.menu_id')
                                    ->where('status', 'available')
                                    ->where('available_date', $selected_date)
                                    ->groupBy('menus.id','menus.profile_menu','menus.catering_id','menus.name','menus.status','menus.price','menus.ordered','menus.description')
                                    ->orderByRaw('menus.price DESC')
                                    ->paginate(50);
                    break;
                }
            }
        }

        return $menus;
    }

    private function filter($request, $menus, $categories, $selected_date){
        if($request->input('filter')){
            if($request->lowest_price == null) $lowest_price = 0;
            else $lowest_price = $request->lowest_price;

            if($request->highest_price == null) $highest_price = 50000000000;
            else $highest_price = $request->highest_price;

            if($request->rating == null) $rating = 0;
            else $rating = $request->rating;

            if($request->categories){
                $selected_categories = $request->categories;
            }else{
                $categories = Category::all();
                foreach($categories as $cg){
                    $selected_categories[] = $cg->name;
                }
            }

            $menus = Menu::select('menus.id','menus.profile_menu','menus.catering_id','menus.name','menus.status','menus.price','menus.ordered','menus.description', DB::raw('(SUM(reviews.rating) / COUNT(reviews.rating))'))
                        ->join('menu_week_details', 'menus.id', '=', 'menu_week_details.menu_id')
                        ->join('reviews', 'menus.id', '=', 'reviews.menu_id')
                        ->join('menu_categories', 'menus.id', '=', 'menu_categories.menu_id')
                        ->join('categories', 'categories.id', '=', 'menu_categories.category_id')
                        ->where('status', 'available')
                        ->where('available_date', $selected_date)
                        ->whereBetween('menus.price', [$lowest_price, $highest_price])
                        ->whereIn('categories.name', $selected_categories)
                        ->groupBy('menus.id','menus.profile_menu','menus.catering_id','menus.name','menus.status','menus.price','menus.ordered','menus.description')
                        ->havingRaw('(SUM(reviews.rating) / COUNT(reviews.rating)) >= ?', [$rating])
                        ->orderByRaw('(SUM(reviews.rating) / COUNT(reviews.rating)) DESC')
                        ->paginate(50);
        }

        return $menus;
    }

    public function catalog(Request $request){
        $categories = category::all();
        $selected_date = $request->input('submit_button');
        $current_date = Carbon::now()->addDays(7)->format('Y-m-d');
        if ($selected_date == null) $selected_date = $current_date;
        $start_date = Carbon::createFromFormat('Y-m-d', $current_date)->startOfWeek();


        $menus = Menu::join('menu_week_details', 'menu_week_details.menu_id', '=', 'menus.id')
                    ->where('status', 'available')
                    ->where('name','LIKE',"%$request->search%")
                    ->where('available_date', $selected_date)
                    ->select('menus.*')
                    ->paginate(50);

        // Seller Catalog
        $archived_menus = null;
        if(Auth::user() && Auth::user()->role == "seller"){
            if ($request->date){
                $start_date = Carbon::createFromFormat('Y-m-d', $request->date)->startOfWeek();
            }

            $temp = $request->input('submit_button');
            if ($temp && !$request->date){
                $timestamp = strtotime($temp);
                $formatted_date = date('Y-m-d', $timestamp);
                $start_date = Carbon::createFromFormat('Y-m-d', $formatted_date)->startOfWeek();
            }

            $user = Auth::user()->id;
            $catering = Catering::where('user_id', $user)->get()->first();
            $catering_id = $catering->id;
            $menus = Menu::join('menu_week_details', 'menu_week_details.menu_id', '=', 'menus.id')
                        ->where('status', 'available')
                        ->where('name','LIKE',"%$request->search%")
                        ->where('catering_id', $catering_id)
                        ->where('available_date', $selected_date)
                        ->select('menus.*')
                        ->paginate(50);

            $archived_menus = menu::where('catering_id', $catering_id)
                                ->where('status', 'archived')
                                ->get();
        }

        // Sorting
        $menus = $this->sorting($request->sort_by, $menus, $selected_date);

        // Filter
        $menus = $this->filter($request, $menus, $categories, $selected_date);

        $week_dates = [];
        $temp_date = $start_date->copy();
        while ($temp_date <= $start_date->copy()->endOfWeek()) {
            $week_dates[] = $temp_date->copy();
            $temp_date->addDay();
        }

        // Add Address
        if($request->address){
            User::where('id', Auth::user()->id)->update([
                'address' => $request->address,
            ]);
        }

        return view('ViewPage.catalog_page', compact('categories','week_dates','menus','archived_menus','selected_date', 'start_date'));
    }

    // public function search(Request $request){
    //     $categories = category::all();
    //     $current_date = Carbon::now();
    //     $menus = Menu::where('name','LIKE',"%$request->search%")->paginate(50);
    //     $start_date = $current_date->startOfWeek();
    //     $week_dates = [];
    //     for ($i = 0; $i < 7; $i++) {
    //         $week_dates[] = $start_date->format('D d');
    //         $start_date->addDay();
    //     }
    //     return view('ViewPage.catalog_page', compact('categories','week_dates','menus'));
    // }

    public function sort(Request $request){
        $categories = category::all();
        $current_date = Carbon::now();
        $menus = Menu::paginate(50);
        $start_date = $current_date->startOfWeek();
        $week_dates = [];
        for ($i = 0; $i < 7; $i++) {
            $week_dates[] = $start_date->format('D d');
            $start_date->addDay();
        };
        return view('ViewPage.catalog_page', compact('categories','week_dates','menus'));
    }

    public function menuDetail($id){
        $submit_button = null;
        if(request('submit_button')){
            $submit_button = request('submit_button');
            $submit_button = date('Y-m-d', strtotime($submit_button));
        }else{
            $current_date = Carbon::now()->addDays(7)->format('Y-m-d');
            $start_date = Carbon::createFromFormat('Y-m-d', $current_date)->startOfWeek();
            $end_date = $start_date->copy()->endOfWeek();

            $available_date = Menu::join('menu_week_details as mwd', 'menus.id', '=', 'mwd.menu_id')
            ->where('menus.id', '=', $id)
            ->where('mwd.available_date', '>=', $current_date)
            ->orderBy('mwd.available_date', 'ASC')
            ->limit(1)
            ->get();

            $submit_button = $availableDate = $available_date[0]->available_date;
        }
        $menus = Menu::find($id);
        $menus = Menu::join('menu_week_details', 'menu_week_details.menu_id', '=', 'menus.id')
                                ->where('menu_week_details.available_date', '=', $submit_button)
                                ->find($id);
        $menus->available_date = Carbon::parse($menus->available_date)->format('l, d F Y');

        return view('ViewPage.menu_detail_page', compact('menus'));
    }

    public function updatemenu(Request $request){
        switch($request->input('action')){
            case 'Edit':
                // $cart = Cart::find($request->id);
                // $cart->quantity = $request->quantity;
                // $cart->save();
                // return redirect('/');
                break;

            default:
                $menu = Menu::find($request->menu_id);
                $menu->delete();
                return redirect()->back();
                break;
        }
    }
}
