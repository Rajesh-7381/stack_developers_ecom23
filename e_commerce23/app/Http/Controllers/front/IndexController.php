<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Products;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index()
    {
        // get homepage slider banner
        $homesliderbanner = Banner::where('type', 'slider')->where('status', 1)->orderBy('sort', 'ASC')->get()->toArray();
        // get homepage fix banner
        $homefixbanner = Banner::where('type', 'fix')->where('status', 1)->orderBy('sort', 'ASC')->get()->toArray();

        // get new arrivals products
        // here we get relationship between brand,images in product model
        $newproducts = Products::with(['brand', 'images'])->where('status', 1)->orderBy('id', 'desc')->limit(8)->get()->toArray();

        // Get new arrival products
        //  $newproducts = Products::with(['brand', 'images'])
        //  ->where('status', 1)
        //  ->orderByDesc('id')
        //  ->limit(8)
        //  ->get();
        // dd($newproducts);


        // get bestsellers
        $getBestSellers = Products::with(['brand', 'images'])
            ->where(['status' => 1]) // Filter by status
            ->where('is_bestseller', true) // Check if 'is_bestseller' is true
            ->inRandomOrder() // Randomize the order
            ->limit(8) // Limit the results to 8
            ->get()
            ->toArray();

        // get discounted  produts
        $discountedProducts = Products::with(['brand', 'images'])->where('product_discount', '>', 0)->where('status', 1)->inRandomOrder()->limit(8)->get()->toArray();

        // featured products
        $featuredproduts = Products::with(['brand', 'images'])
            ->where(['status' => 1]) // Filter by status
            ->where('is_featured', true) // Check if 'is_bestseller' is true
            ->inRandomOrder() // Randomize the order
            ->limit(8) // Limit the results to 8
            ->get()
            ->toArray();
        return view('front.index')->with(compact('homesliderbanner', 'homefixbanner', 'newproducts', 'getBestSellers', 'discountedProducts','featuredproduts'));
    }
}
