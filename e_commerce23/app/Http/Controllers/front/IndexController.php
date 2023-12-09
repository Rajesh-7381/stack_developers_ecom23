<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Products;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index(){
        // get homepage slider banner
        $homesliderbanner=Banner::where('type','slider')->where('status',1)->orderBy('sort','ASC')->get()->toArray();
        // get homepage fix banner
        $homefixbanner=Banner::where('type','fix')->where('status',1)->orderBy('sort','ASC')->get()->toArray();

        // get new arrivals products
        // here we get relationship between brand,images in product model
        $newproducts=Products::with(['brand','images'])->where('status',1)->orderBy('id','desc')->limit(4)->get()->toArray();

         // Get new arrival products
        //  $newproducts = Products::with(['brand', 'images'])
        //  ->where('status', 1)
        //  ->orderByDesc('id')
        //  ->limit(4)
        //  ->get();
        // dd($newproducts);
        return view('front.index')->with(compact('homesliderbanner','homefixbanner','newproducts'));
    }
}
