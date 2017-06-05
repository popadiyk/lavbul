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


Route::get('/', function () {
    return view('main_page');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contacts', function (){
    return view('contacts_page');
});
Route::get('/feedbacks', 'FeedbacksController@index');


Route::resource('/products', 'ProductController');

Route::resource('/invoices', 'InvoiceController');
Route::get('/invoices/generatePdf/{id}', 'InvoiceController@generatePdf');


Route::resource('shop', 'ProductController', ['only' => ['index', 'show']]);
Route::resource('cart', 'CartController');
Route::delete('emptyCart', 'CartController@emptyCart');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
Route::resource('order', 'OrderController');

Route::get('/one_product', function() {
	return view('one_product_page');
});

Route::get('test_test', function(){
    MakingOrder::test();
});

Route::get('/product', function() {
	return view('products_page');
});
