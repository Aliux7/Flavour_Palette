<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\menu_week_detail;
use App\Models\Order_detail;
use App\Models\Order_header;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function cart(){
        $user = Auth::user();

        $carts = Cart::join('menus', 'menus.id', '=', 'carts.menu_id')
            ->join('menu_week_details', 'menu_week_details.menu_id', '=', 'menus.id')
            ->join('users', 'users.id', '=', 'carts.user_id')
            ->where('users.id', '=', $user->id)
            ->whereColumn('menu_week_details.available_date', 'carts.available_date')
            ->select('carts.*')
            ->get();

        return view('ViewPage.cart_page', compact('carts'));
    }

    public function addcart(Request $request){
        $date = DateTime::createFromFormat("l, d F Y", $request->available_date);
        $chooseDate = $date->format("Y-m-d");
        if (Auth::user()){
            $user = Auth::user();
            $menu = Menu::find($request->menu_id);
            $item = Cart::where('user_id', $user->id)->where('menu_id',$menu->id)->where('available_date', $chooseDate)->get();
            if($item->count() == 0){
                $quantity = $request->quantity;
                Cart::insert([
                    'id' => Str::uuid()->toString(),
                    'user_id' => $user->id,
                    'menu_id' => $menu->id,
                    'available_date' => $chooseDate,
                    'quantity' => $quantity
                ]);
            }else{
                $quantity = $item->first()->quantity + $request->quantity;
                Cart::where('user_id', $user -> id)->where('menu_id',$menu -> id)->delete();
                Cart::insert([
                    'id' => Str::uuid()->toString(),
                    'user_id' => $user->id,
                    'menu_id' => $menu->id,
                    'available_date' => $chooseDate,
                    'quantity' => $quantity
                ]);
            }
            Session::put('success-message', 'Product added to cart successfully!');
            return redirect('/');
        }else{
            return redirect('/login');
        }
    }

    public function updateQuantity(Request $request){
        $cart = Cart::find($request->id);
        if ($request->type == "add"){
            $cart->quantity += 1;
            $cart->save();
        } else if ($request->type == "minus"){
            if ($cart->quantity > 1){
                $cart->quantity -= 1;
                $cart->save();
            }
        } else if ($request->type == "change"){
            if ($request->quantity > 0){
                $cart->quantity = $request->quantity;
                $cart->save();
            }
        }

        return response()->json([
            'quantity' => $cart->quantity
        ]);
    }

    public function delivery(Request $request){
        if($request->address){
            User::where('id', Auth::user()->id)->update([
                'address' => $request->address,
            ]);
        }

        $user = Auth::user();

        $carts = Cart::join('menus', 'menus.id', '=', 'carts.menu_id')
            ->join('menu_week_details', 'menu_week_details.menu_id', '=', 'menus.id')
            ->join('users', 'users.id', '=', 'carts.user_id')
            ->where('users.id', '=', $user->id)
            ->whereColumn('menu_week_details.available_date', 'carts.available_date')
            ->select('carts.*')
            ->get();


        return view('ViewPage.delivery_page', compact('carts'));
    }

    public function checkout(Request $request){
        $user = Auth::user();
        $carts = Cart::join('menus', 'menus.id', '=', 'carts.menu_id')
            ->join('menu_week_details', 'menu_week_details.menu_id', '=', 'menus.id')
            ->join('users', 'users.id', '=', 'carts.user_id')
            ->where('users.id', '=', $user->id)
            ->whereColumn('menu_week_details.available_date', 'carts.available_date')
            ->select('carts.*')
            ->get();

        $orderHeaderId = Str::uuid()->toString();
        Order_header::insert([
            'id' => $orderHeaderId,
            'user_id' => Auth::user()->id,
            'order_date' => Carbon::now(),
            'total_price' => $request->total_price
        ]);

        foreach($carts as $cart){
            Order_detail::insert([
                'order_id' => $orderHeaderId,
                'menu_id' => $cart->menu->id,
                'arrival_date'=> $cart->available_date,
                'quantity' => $cart->quantity,
                'status' => 'Waiting'
            ]);
            $cart->delete();
        }
        return redirect()->action([MenuController::class, 'home']);
    }
}
