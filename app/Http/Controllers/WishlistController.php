<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    //
    public function wishlist(){
        $menus = Menu::join('wishlists', 'wishlists.menu_id', '=', 'menus.id')
                        ->join('users', 'users.id', '=', 'wishlists.user_id')
                        ->where('user_id', Auth::user()->id)
                        ->select('menus.*')
                        ->paginate(3);
        return view('ViewPage.wishlist_page', compact('menus'));
    }

    public function updatewishlist(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            $countWishlist = wishlist::countWishlist($data['menu_id']);

            $wishlist = new Wishlist;
            if($countWishlist == 0){
                $wishlist->menu_id = $data['menu_id'];
                $wishlist->user_id = $data['user_id'];
                $wishlist->save();
                return response()->json(['action' => 'add', 'message' => 'Product Added Successfully to Wishlist']);
            }else{
                Wishlist::where(['user_id' => Auth::user()->id, 'menu_id' => $data['menu_id']])->delete();
                return response()->json(['action' => 'remove', 'message' => 'Product Remove Successfully to Wishlist']);
            }
        }
    }
}
