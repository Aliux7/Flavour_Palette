<?php

namespace App\Http\Controllers;

use App\Models\Catering;
use App\Models\Menu;
use App\Models\Order_detail;
use App\Models\Order_header;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageController extends Controller
{

    public function manageorder(Request $request){
        $selected_date = $request->input('submit_button');
        $current_date = Carbon::now()->format('Y-m-d');
        if ($selected_date == null) $selected_date = $current_date;
        $start_date = Carbon::createFromFormat('Y-m-d', $current_date)->startOfWeek();

        $archived_menus = null;
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
        $order_header = Order_header::distinct()
                        ->select('order_headers.*')
                        ->join('order_details', 'order_details.order_id', '=', 'order_headers.id')
                        ->join('users', 'users.id', '=', 'order_headers.user_id')
                        ->join('menus', 'menus.id', '=', 'order_details.menu_id')
                        ->join('caterings', 'caterings.id', '=', 'menus.catering_id')
                        ->where('menus.catering_id', $catering_id)
                        ->where('menus.name','LIKE',"%$request->search%")
                        ->paginate(4);

        $week_dates = [];
        $temp_date = $start_date->copy();
        while ($temp_date <= $start_date->copy()->endOfWeek()) {
            $week_dates[] = $temp_date->copy();
            $temp_date->addDay();
        }

        return view('ViewPage.manage_order_page', compact('week_dates','order_header','selected_date', 'start_date'));
    }

    public function orderdetail($id, Request $request)
    {
        $order_header = Order_header::find($id);

        if ($request->input('accept')) {
            $order_header->order_detail()->where('status', 'Waiting')->update(['status' => 'In Progress']);
        } else if($request->input('updatestatus')){
            $order_header->order_detail()->where('arrival_date', $request->input('updatestatus'))->update(['status' => 'In Delivery']);
        }

        return view('ViewPage.order_detail_page', compact('order_header'));
    }

    public function orderhistory(Request $request){
        $selected_date = $request->input('submit_button');
        $current_date = Carbon::now()->format('Y-m-d');
        if ($request->date) $selected_date = $request->date;
        // else if ($selected_date == null) $selected_date = $current_date;

        $user_id = Auth::user()->id;
        $order_header = Order_header::distinct()
                        ->select('order_headers.*')
                        ->join('order_details', 'order_details.order_id', '=', 'order_headers.id')
                        ->join('users', 'users.id', '=', 'order_headers.user_id')
                        ->join('menus', 'menus.id', '=', 'order_details.menu_id')
                        ->join('caterings', 'caterings.id', '=', 'menus.catering_id')
                        ->where('order_headers.user_id', $user_id)
                        ->where('caterings.name','LIKE',"%$request->search%")
                        // ->where('order_headers.order_date', '=', $selected_date) masih error
                        ->paginate(4);

        return view('ViewPage.order_history_page', compact('order_header','selected_date'));
    }
}
