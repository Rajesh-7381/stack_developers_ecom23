<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Products;

class productController extends Controller
{
    //
    public function listing(Request $request,$url){
        //    echo $url=Route::getFacadeRoot()->current()->url;die;
         
            $url=Route::getFacadeRoot()->current()->url;
            $categoryCount=Category::where(['url'=>$url,'status'=>1])->count();
            // dd($categoryCount);

            if($categoryCount > 0){
                // echo "category exists";
    
                // get category details
                $getcategoryDetails=Category::categoryDetails($url);
                // dd($getcategoryDetails);

                // / get category and their subcategory products
                // $categoryIds = is_array($categoryDetails['catids']) ? $categoryDetails['catids'] : [$categoryDetails['catids']];
                $categoryproducts = Products::with(['brand', 'images'])
                    ->whereIn('category_id', $getcategoryDetails['catIds'])
                    ->where('status', 1)
                    ->orderBy('id', 'Desc')
                    ->get()
                    ->toArray();
                    // dd($categoryproducts);
                    return view('front.products.listing')->with(compact('getcategoryDetails','categoryproducts'));
                
            }else{
                abort(404);
            }
            
    }
}
// / get category and their subcategory products
//                 // $categoryIds = is_array($categoryDetails['catids']) ? $categoryDetails['catids'] : [$categoryDetails['catids']];
//                 $categoryproducts = Products::with(['brand', 'images'])
//                     ->whereIn('category_id', $getcategoryDetails)
//                     ->where('status', 1)
//                     ->orderBy('id', 'Desc')
//                     ->get()
//                     ->toArray();
//                     // dd($categoryproducts);