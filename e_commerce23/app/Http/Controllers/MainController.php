<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    public static function login(){
        return view('admin.login');
    }
    public static function dashboard(){
        return view('admin.dashboard');
    }
}
