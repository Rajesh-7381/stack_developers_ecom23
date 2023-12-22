<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\ProductFilter;
use App\Models\Products;
use Illuminate\Support\Facades\View;


class productController extends Controller
{
    //
    public function listing(Request $request, $url)
    {
        //    echo $url=Route::getFacadeRoot()->current()->url;die;

        $url = Route::getFacadeRoot()->current()->url;
        $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
        // dd($categoryCount);

        if ($categoryCount > 0) {
            // echo "category exists";

            // get category details
            $categoryDetails = Category::categoryDetails($url);
            // dd($categoryDetails);

            // / get category and their subcategory products
            // $categoryIds = is_array($categoryDetails['catids']) ? $categoryDetails['catids'] : [$categoryDetails['catids']];
            // without pagination
            // $categoryproducts = Products::with(['brand', 'images'])
            //     ->whereIn('category_id', $categoryDetails['catIds'])
            //     ->where('status', 1)
            //     ->orderBy('id', 'Desc')
            //     ->get()
            //     ->toArray();
            // dd($categoryproducts);



            // with pagination
            // $categoryproducts = Products::with(['brand', 'images'])
            //     ->whereIn('category_id', $categoryDetails['catIds'])
            //     ->where('status', 1)
            //     ->orderBy('id', 'Desc')->simplePaginate(1);
            //     // dd($categoryproducts);


            //     // with normal pagination
            // $categoryproducts = Products::with(['brand', 'images'])
            //     ->whereIn('category_id', $categoryDetails['catIds'])
            //     ->where('status', 1)
            //     ->orderBy('id', 'Desc')->paginate(1);
            // dd($categoryproducts);
            // here also start with pagination when i sorting thats why use beloew pagination
            $categoryproducts = Products::with(['brand', 'images'])
                ->whereIn('category_id', $categoryDetails['catIds'])
                ->where('products.status', 1);
            // dd($categoryproducts);

            // products sorting
            if (isset($request['sort']) && !empty($request['sort'])) {
                if ($request['sort'] == "product_latest") {
                    $categoryproducts->orderBy('id', 'Desc');
                } else if ($request['sort'] == "lowest_price") {
                    $categoryproducts->orderBy('final_price', 'ASC');
                } else if ($request['sort'] == "highest_price") {
                    $categoryproducts->orderBy('final_price', 'Desc');
                } else if ($request['sort'] == "best_selling") {
                    $categoryproducts->where('is_bestseller', 'Yes');
                } else if ($request['sort'] == "featured_items") {
                    $categoryproducts->where('is_featured', 'Yes');
                } else if ($request['sort'] == "discounted_items") {
                    $categoryproducts->where('product_discount', '>', 0);
                } else {
                    $categoryproducts->orderBy('products.id', 'Desc');
                }
            }
            // update query for product color
            if(isset($request['color']) && !empty($request['color'])){
                $colors=explode('~',$request['color']);
                $categoryproducts->whereIn('products.family_color',$colors);
            }

            // update query for size
            if(isset($request['size']) && !empty($request['size'])){
                $sizes=explode('~',$request['size']);
                // $categoryproducts->join('products_attributes','products_attributes.product_id','=','products.id')->whereIn('products_attributes.size',$sizes)->groupBy('products_attributes.product_id');
                $categoryproducts->join('products_attributes','products_attributes.product_id','=','products.id')->whereIn('products_attributes.size',$sizes);
            }
            // update query for brand
            if(isset($request['brand']) && !empty($request['brand'])){
                $brands=explode('~',$request['brand']);
                $categoryproducts->whereIn('products.brand_id',$brands);
            }
            // update query for price
            if(isset($request['price']) && !empty($request['price'])){
                $request['price']=str_replace("~","-",$request['price']);
                $prices=explode('-',$request['price']);
                $count=count($prices);
                $categoryproducts->whereBetween('products.final_price', [$prices[0], $prices[$count - 1]]);
            }
            // update query for dynamic filters
                $filterTypes=ProductFilter::filterTypes();
                // dd($filterTypes);
                foreach($filterTypes as $key => $filter){
                    // dd($filter);
                    if($request->$filter){
                        $explodefiltervals=explode('~',$request->$filter);
                        // dd($explodefiltervals);
                        $categoryproducts->whereIn($filter,$explodefiltervals);
                        // dd($categoryproducts);
                    }
                }               
                
            $categoryproducts = $categoryproducts->paginate(8);
            if ($request->ajax()) {
                return response()->json([
                    'view' => (String)View::make('front.products.ajax_product_listing')
                        ->with(compact('categoryDetails', 'categoryproducts', 'url'))
                ]);
            } else {
                return view('front.products.listing')->with(compact('categoryDetails', 'categoryproducts', 'url'));
            }
        } else {
            abort(404);
        }
    }
}
// / get category and their subcategory products
//                 // $categoryIds = is_array($categoryDetails['catids']) ? $categoryDetails['catids'] : [$categoryDetails['catids']];
//                 $categoryproducts = Products::with(['brand', 'images'])
//                     ->whereIn('category_id', $categoryDetails)
//                     ->where('status', 1)
//                     ->orderBy('id', 'Desc')
//                     ->get()
//                     ->toArray();
//                     // dd($categoryproducts);