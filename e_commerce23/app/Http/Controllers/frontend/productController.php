<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\ProductFilter;
use App\Models\Products;
use App\Models\ProductsAttributes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
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
            if (isset($request['color']) && !empty($request['color'])) {
                $colors = explode('~', $request['color']);
                $categoryproducts->whereIn('products.family_color', $colors);
            }

            // update query for size
            if (isset($request['size']) && !empty($request['size'])) {
                $sizes = explode('~', $request['size']);
                // $categoryproducts->join('products_attributes','products_attributes.product_id','=','products.id')->whereIn('products_attributes.size',$sizes)->groupBy('products_attributes.product_id');
                $categoryproducts->join('products_attributes', 'products_attributes.product_id', '=', 'products.id')->whereIn('products_attributes.size', $sizes);
            }
            // update query for brand
            if (isset($request['brand']) && !empty($request['brand'])) {
                $brands = explode('~', $request['brand']);
                $categoryproducts->whereIn('products.brand_id', $brands);
            }
            // update query for price
            if (isset($request['price']) && !empty($request['price'])) {
                $request['price'] = str_replace("~", "-", $request['price']);
                $prices = explode('-', $request['price']);
                $count = count($prices);
                $categoryproducts->whereBetween('products.final_price', [$prices[0], $prices[$count - 1]]);
            }
            // update query for dynamic filters
            $filterTypes = ProductFilter::filterTypes();
            // dd($filterTypes);
            foreach ($filterTypes as $key => $filter) {
                // dd($filter);
                if ($request->$filter) {
                    $explodefiltervals = explode('~', $request->$filter);
                    // dd($explodefiltervals);
                    $categoryproducts->whereIn($filter, $explodefiltervals);
                    // dd($categoryproducts);
                }
            }

            $categoryproducts = $categoryproducts->paginate(8);
            if ($request->ajax()) {
                return response()->json([
                    'view' => (string)View::make('front.products.ajax_product_listing')
                        ->with(compact('categoryDetails', 'categoryproducts', 'url'))
                ]);
            } else {
                return view('front.products.listing')->with(compact('categoryDetails', 'categoryproducts', 'url'));
            }
        } else {
            abort(404);
        }
    }

    // details
    public function detail($id)
    {
        $prductCount = Products::where('status', 1)->where('id', $id)->count();
        if ($prductCount == 0) {
            abort(404);
        }

        $productDetails = Products::with(['category', 'brand', 'images', 'attributes' => function ($query) {
            $query->where('stock', '>', 0)->where('status', 1);
        }])->find($id)->toArray();
        //->toArray(): Converts the retrieved model instance (or collection of instances) into an array
        $categoryDetails = Category::categoryDetails($productDetails['category']['url']);
        // dd($productDetails);    

        // get group products(group color)
        $groupProducts = array();
        if (!empty($productDetails['group_code'])) {
            $groupProducts = Products::select('id', 'product_color')->where('id', '!=', $id)->where(['group_code' => $productDetails['group_code'], 'status' => 1])->get()->toArray();
            // dd($groupProducts);
        }

        // get related products
        $relatedProducts = Products::with('brand', 'images')->where('category_id', $productDetails['category']['id'])->where('id', '!=', $id)->inRandomOrder()->limit(4)->get()->toArray();
        // dd($relatedProducts);

        // set session for recently viewed items
        // Check if the 'session_id' exists in the session data
        if (empty(Session::get('session_id'))) {
            // Generate a new session ID using md5 and uniqid
            $session_id = md5(uniqid(rand(), true));
        } else {
            // Retrieve the existing session ID
            $session_id = Session::get('session_id');
        }

        // Store the session ID in the session
        Session::put('session_id', $session_id);

        // Check if the current product has already been recently viewed by the current session ID
        $countRecentlyvieweditems = DB::table('recently_viewed_items')
            ->where(['product_id' => $id, 'session_id' => $session_id])
            ->count();

        // If the product has not been viewed recently, insert it into the 'recently_viewed_items' table
        if ($countRecentlyvieweditems == 0) {
            DB::table('recently_viewed_items')->insert([
                'product_id' => $id,
                'session_id' => $session_id
            ]);
        }
        // get product ids
        $recentlyproductids = DB::table('recently_viewed_items')->select('product_id')->where('product_id', '!=', $id)->where('session_id', $session_id)->inRandomOrder()->get()->take(4)->pluck('product_id');
        // dd($recentlyproductids);
        // sql format->$_COOKIESELECT product_id
        // (FROM recently_viewed_items WHERE product_id != $id   AND session_id = $session_id ORDER BY RAND() LIMIT 4)


        // get recently viewed products
        $recentlyproducts = Products::with('brand', 'images')->whereIn('id', $recentlyproductids)->get()->toArray();
        // dd($recentlyproducts);

        return view('front.products.detail')->with(compact('productDetails', 'categoryDetails', 'groupProducts', 'relatedProducts', 'recentlyproducts'));
    }
    public function getAttributePrice(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // Process $data as needed
            // echo "<pre>";print_r($data);die;
            $getAttributePrice = Products::getAttributePrice($data['product_id'], $data['size']);
            // echo "<pre>";print_r($getAttributePrice);die;

            return $getAttributePrice;
        }
    }
    // add to cart
    public function addToCart(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            // Check product in stock
            $productStock = ProductsAttributes::productStock($data['product_id'], $data['size']);
            if ($data['qty'] > $productStock) {
                $message = "Required Quantity is not available";
                return response()->json(['status' => false, 'message' => $message]);
            }

            $productStatus = Products::productstatus($data['product_id']);
            if ($productStatus == 0) {
                $message = "Product is not available";
                return response()->json(['status' => false, 'message' => $message]);
            }

            // Generate session ID if not exists
            $session_id = Session::get('session_id');
            if (empty($session_id)) {
                $session_id = Session::getId();
                Session::put('session_id', $session_id);
            } else {
                $session_id = Session::get('session_id');
            }

            // Check if product already exists in the user cart
            $user_id = Auth::check() ? Auth::user()->id : 0;
            $countProducts = Carts::where([
                'product_id' => $data['product_id'],
                'product_size' => $data['size'],
                'session_id' => $session_id,
                'user_id' => $user_id // Add user ID condition
            ])->count();

            if ($countProducts > 0) {
                $message = "Product already exists in cart!";
                return response()->json(['status' => false, 'message' => $message]);
            }

            // Save the product in the cart
            $item = new Carts;
            $item->session_id = $session_id;
            $item->user_id = $user_id; // Assign the user ID
            $item->product_id = $data['product_id'];
            $item->product_size = $data['size'];
            $item->product_qty = $data['qty'];
            $item->save();

            // get total cart items
            $totalcartitems=totalcartitems();
            $message = 'Product added successfully! <a href="/cart" style="color:white; text-decoration:underline;"> View Cart</a>';
            return response()->json(['status' => true, 'message' => $message,'totalcartitems'=>$totalcartitems]);
        }
    }
    public function cart()
    {
        $getCartItems = getCartItems();
        // dd($getCartItems);
        return view('front.products.cart')->with(compact('getCartItems'));
    }
    public function updatecartitemQTY(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            // update the cart quantity

            // get cart details
            $cartDetails = Carts::find($data['cartid']);
            // dd($cartDetails);

            // get available product in stock
            $availableStocks = ProductsAttributes::select('stock')->where(['product_id' => $cartDetails['product_id'], 'size' => $cartDetails['product_size']])->first();
            // $availableStocks=ProductsAttributes::select('stock')->where(['product_id'=>$cartDetails['cartid'],'size'=>$cartDetails['product_size']])->first()->toArray();
            // dd($availableStocks);
            // echo "<pre>";print_r($availableStocks);die;

            // check if the desired stock is availablein stock then do some action
            if ($data['qty'] > $availableStocks['stock']) {
                $getCartItems = Carts::getCartItems();
                return response()->json([
                    'status' => false,
                    'message' => 'product stock is not available',
                    'view' => (string)View::make('front.products.cart_items')->with(compact('getCartItems'))
                ]);
            }
            // check product size is available
            $availablesize = ProductsAttributes::where(['product_id' => $cartDetails['product_id'], 'size' => $cartDetails['product_size'], 'status' => 1])->count();
            echo "<pre>";
            print_r($availablesize);
            die;
            // check if the desired size is available 
            if ($availablesize == 0) {
                $getCartItems = Carts::getCartItems();
                return response()->json([
                    'status' => false,
                    
                    'message' => 'product size is not available. please remove and choose another one!',
                    'view' => (string)View::make('front.products.cart_items')->with(compact('getCartItems'))
                ]);
            }
            // update cart item qty
            Carts::where('id', $data['cartid'])->update(['product_qty' => $data['qty']]);
            // get update cart item
            $getCartItems = Carts::getCartItems();
            // get total cart items
            $totalcartitems=totalcartitems();

            // dd($getCartItems);
            return response()->json([
                'status' => true,
                // 'message'=>'product stock is not available',
                'totalcartitems'=>$totalcartitems,
                'view' => (string)View::make('front.products.cart_items')->with(compact('getCartItems'))
            ]);

            // return updated cart item via ajax
        }
    }
    public function deletecartitem(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            Carts::where('id', $data['cartid'])->delete();
            // update cart item
            $getCartItems = Carts::getCartItems();

            // get total cart items
            $totalcartitems=totalcartitems(); 

            // return update cart items
            return response()->json([
                'status' => true,

                'view' => (string)View::make('front.products.cart_items')->with(compact('getCartItems'))
            ]);
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