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


Auth::routes();
//admin
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
Route::get('/', function () {
    return view('welcome');
	});
Route::group(['middleware' => ['auth']], function() 
{
	//ADMIN DASHBOARD
    Route::get('/home', 'Admin\HomeController@index')->name('home');
    //PRODUCT
	Route::get('productListing','Admin\ProductController@index')->name('productListing');
	Route::post('productInsert','Admin\ProductController@insert');
	Route::get('productEdit','Admin\ProductController@edit')->name('prdEdit');
	Route::post('productUpdate/{id}','Admin\ProductController@update');
	Route::get('productDelete','Admin\ProductController@delete')->name('prdDelete');
	Route::get('updateStatus','Admin\ProductController@updatestatus')->name('prd.statusUpdate');
	//ORDER
	Route::get('orderListing','Admin\OrderController@getorderdetails')->name('orders');

    //FRONTEND 
	Route::get('product','Frontend\FrontendController@index')->name('customer.productList');
	//CART
	Route::post('add-to-cart','Frontend\CartController@addtocart');
	Route::get('/load-cart-data','Frontend\CartController@cartload');
	Route::get('/cart','Frontend\CartController@index')->name('viewcart');
	Route::post('update-to-cart','Frontend\CartController@updatetocart');
	Route::delete('delete-from-cart','Frontend\CartController@deletefromcart');
	Route::get('clear-cart','Frontend\CartController@clearcart');
	//Checkout
	Route::post('/checkout','Frontend\CheckoutController@checkouttocart');
});
