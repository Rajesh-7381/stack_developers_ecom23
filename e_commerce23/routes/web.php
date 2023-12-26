<?php

// use App\Http\Controllers\MainController;

use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\admin\ProductsController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\front\IndexController;
use App\Http\Controllers\frontend\productController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
    Route::match(['get', 'post'], '/login', [MainController::class, 'login']);
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/dashboard', [MainController::class, 'dashboard']);
        Route::match(['get', 'post'],'/updatepassword', [MainController::class, 'updatepassword']);
        Route::match(['get', 'post'],'/updateadmindetails', [MainController::class, 'updateAdminDetails']);
        Route::post('/checkcurrentpassword', [MainController::class, 'checkcurrentpassword']);
        Route::get('/logout',[MainController::class,'logout']);

        // cms page
        Route::get('cms-page',[CmsController::class,'index']);
        Route::post('update-status-cms-page',[CmsController::class,'update']);
        Route::match(['get','post'],'add-edit-cms-page/{id?}',[CmsController::class,'edit'])->name('admin.add-edit-cms-page');
        Route::get('delete-cms-page/{id?}',[CmsController::class,'destroy']);

        // subadmins
        Route::get('sub-admins',[MainController::class,'sub_admins']);
        // Route::post('update-subadmin-status',[MainController::class,'updatesubadminstatus']);
        Route::post('update-status-subadmin-page',[MainController::class,'updatesubadminstatus']);
        Route::match(['get','post'],'add-edit-subadmins-page/{id?}',[MainController::class,'addupdatesubadminDetails']);
        Route::match(['get','post'],'update-role/{id?}',[MainController::class,'UpdateRole']);
        Route::get('delete-subadmin-page/{id?}',[MainController::class,'deletesubadmins']);

        // categories
        Route::get('categories',[CategoryController::class,'categories']);
        Route::post('update-status-category-page',[CategoryController::class,'updatecategorystatus']);
        // Route::post('update-category-status',[CategoryController::class,'updatecategorystatus']);
        Route::match(['get','post'],'add-edit-category-page/{id?}',[CategoryController::class,'addedit'])->name('admin.add-edit-category-page');
        // Route::match(['get','post'],'oop/{id?}',[CategoryController::class,'addedit']);

        Route::get('delete-category-page/{id?}',[CategoryController::class,'deletecategory']);
        // Route::get('delete-category-image/{id?}',[CategoryController::class,'deletecategoryimage']);


        // products
        Route::get('products',[ProductsController::class,'products']);
        Route::post('update-status-product-page',[ProductsController::class,'updateproductstatus']);
        Route::match(['get','post'],'add-edit-product-page/{id?}',[ProductsController::class,'addedit']);
        Route::get('delete-product-page/{id?}',[ProductsController::class,'deleteproduct']);
        // product videos
        Route::get('delete-product-video/{id?}',[ProductsController::class,'productvideo']);
        // product images
        Route::get('delete-product-image/{id?}',[ProductsController::class,'productimage']);
        // product attributes
        Route::post('update-status-attribute-page',[ProductsController::class,'updateattributestatus']);
        Route::get('delete-attribute-page/{id?}',[ProductsController::class,'deleteattribute']);


        // brands
        Route::get('brands',[BrandController::class,'brands']);
        Route::post('update-status-brand-page',[BrandController::class,'updatebrandstatus']);
        Route::match(['get','post'],'add-edit-brand-page/{id?}',[BrandController::class,'addedit']);
        Route::get('delete-brand-page/{id?}',[BrandController::class,'deletebrand']);
        // Route::match(['get','post'],'add-edit-brand-page/{id?}',[BrandController::class,'addedit']);
        Route::get('delete-brand-image/{id?}',[BrandController::class,'brandimage']);
        Route::get('delete-brand-logo/{id?}',[BrandController::class,'brandlogo']);

        // banners
        Route::get('banners',[BannerController::class,'banners']);
        Route::post('update-status-banner-page',[BannerController::class,'updatebannerstatus']);
        Route::get('delete-banner-page/{id?}',[BannerController::class,'deletebanner']);
        Route::match(['get', 'post'], 'add-edit-banner-page/{id?}', [BannerController::class, 'addedit']);
    });
});

// Route::get('login',[MainController::class,'login']);
// Route::get('dashboard',[MainController::class,'dashboard']);



// frontend 
Route::namespace('App\Http\Controllers\front')->group(function(){
    Route::get('/',[IndexController::class,'index'])->name('fronthome');
    Route::get('product/{id}',[ProductController::class,'detail']);
    
// In Laravel's Eloquent, the pluck() method is used to retrieve a list of values from a specific column in the database table query result. It transforms the query result into a simple array containing values from the specified column.

    // listing Categories
// Retrieving URLs of active categories from the 'categories' table
$catURLs = Category::select('url') // Selecting only the 'url' column
                ->where('status', 1) // Filtering rows where 'status' is equal to 1 (active categories)
                ->get() // Executing the query and fetching the matching rows
                ->pluck('url'); // Extracting an array of 'url' column values

// $catURLs now contains an array of URLs from active categories in the database
foreach ($catURLs as $key => $url) {
    
Route::get('{url}', [ProductController::class, 'listing'])
->where('url', '.*'); // Wildcard route to capture all URLs
}

    // dd($catURLs);
    // get product attribute price
    Route::post('/get-attribute-price', [ProductController::class, 'getAttributePrice']);

    
});
