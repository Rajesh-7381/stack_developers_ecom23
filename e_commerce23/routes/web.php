<?php

// use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
    Route::match(['get', 'post'], '/login', [MainController::class, 'login']);
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/dashboard', [MainController::class, 'dashboard']);
        Route::match(['get', 'post'],'/updatepassword', [MainController::class, 'updatepassword']);
        Route::match(['get', 'post'],'/updateadmindetails', [MainController::class, 'updateAdminDetails']);
        Route::post('/checkcurrentpassword', [MainController::class, 'checkcurrentpassword']);
        Route::get('/logout',[MainController::class,'logout']);
    });
});

// Route::get('login',[MainController::class,'login']);
// Route::get('dashboard',[MainController::class,'dashboard']);
