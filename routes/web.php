<?php

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

Route::get('/test', 'TestController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/feedbacks', 'FeedbacksController@index');

Route::resource('/products', 'ProductController');

Route::resource('/invoices', 'InvoiceController');
Route::get('/invoices/generatePdf/{id}', 'InvoiceController@generatePdf');

Route::resource('shop', 'ProductController', ['only' => ['index', 'show']]);
Route::resource('cart', 'CartController');
Route::get('js_cart/get_info_total', 'CartController@getTotalQty');




Route::delete('emptyCart', 'CartController@emptyCart');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
Route::resource('order', 'OrderController');

Route::get('test_test', function(){
    MakingOrder::test();
});

Route::group(['prefix' => '/'], function () {
	Route::get('/', function () {
	    return view('main.index');
	});
	Route::get('products', 'HomeController@products');
	Route::get('product', function() {
		return view('products.product');
	});
	Route::get('contacts', function (){
	    return view('contacts.index');
	});
	Route::get('news', function (){
	    return view('news.index');
	});
	Route::get('one_news', function (){
	    return view('news.one_news');
	});
	Route::get('master_classes', function (){
	    return view('master_classes.index');
	});

	Route::get('order', function (){
	    return view('order.index');
	});

	Route::get('about', function (){
	    return view('about_us.index');
	});
});

