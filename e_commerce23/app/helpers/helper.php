<?php

use App\Models\Carts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

function totalcartitems(){
    if(Auth::check()){
        $user_id=Auth::user()->id;
        $totalcartitems=Carts::where('user_id',$user_id)->sum('product_qty');
    }else{
        $session_id=Session::get('session_id');
        $totalcartitems=Carts::where('session_id',$session_id)->sum('product_qty');
    }
    return $totalcartitems;
}
 function getCartItems(){
    if(Auth::check()){
        // if the user loggd in check from auth user_id
        $user_id=Auth::user()->id;
        $getCartItems=Carts::with('product')->where('user_id',$user_id)->get()->toArray();
    }else{
        // if the user not logged in checked from session
        $session_id=Session::get('session_id');
        $getCartItems=Carts::with('product')->where('session_id',$session_id)->get()->toArray();

    }
    return $getCartItems;
}
// for empty cart
 function emptyCart(){
    if(Auth::check()){
        // if the user loggd in check from auth user_id
        $user_id=Auth::user()->id;
        Carts::with('product')->where('user_id',$user_id)->delete();
    }else{
        // if the user not logged in checked from session
        $session_id=Session::get('session_id');
        Carts::with('product')->where('session_id',$session_id)->delete();

    }
    // return $getCartItems;
}
?>