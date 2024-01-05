<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class Carts extends Model
{
    use HasFactory;
    protected $table='carts';
    public static function getCartItems(){
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
    public function product(){
        return $this->belongsTo(Products::class,'product_id')->with('brand','images');
    }
}
