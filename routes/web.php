<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::group([
    'middleware' => ['checkValidIp'], //中介軟體：：從HTTP發出請求後，到應用程式接收回應前，用來處理特定用途的程式
    'prefix' => 'web', //設定前綴用詞
    'namespace' => 'web'  //設定命名空間，通常會跟prefix放在一起
],function(){
    //多個Route放置位置
    Route::get('/index','HomeController@index');
    Route::post('/print','HomeController@print');
});
*/
Route::get('/',function(){
    return view('welcome');
});
Route::resource('products','ProductController');
Route::resource('carts','CartController');
Route::resource('cart-items','CartItemController');