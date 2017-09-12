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
Route::post('/user/edit/{id}', 'HomeController@editUser');
Route::get('/feedbacks', 'FeedbacksController@index');

Route::resource('/products', 'ProductController');

Route::resource('/invoices', 'InvoiceController');
Route::get('/invoices/generatePdf/{id}', 'InvoiceController@generatePdf');

Route::resource('shop', 'ProductController', ['only' => ['index', 'show']]);
Route::resource('cart', 'CartController');
Route::post('add_to_cart', 'CartController@store_js');
Route::post('/get_cart', 'CartController@getCart');
Route::post('/delete_product/{id}', 'CartController@deleteProductFromCart');
Route::post('/js_cart/get_info_total', 'CartController@getTotalQty');

//AJAX for sorting
Route::post('/products/sorting', 'HomeController@filterSorting');
//AJAX for pagination
Route::post('/products/pagination', 'HomeController@pagination');
//AJAX for MC register
Route::post('/mc/register', 'HomeController@mcreg');
// AJAX for Cash_balance_widget
Route::post('/admin/cash_balance', 'HomeController@getCashBalance');
Route::post('/send_feedback', 'HomeController@sendFeedBack');


Route::delete('emptyCart', 'CartController@emptyCart');

Route::group(['prefix' => 'admin'], function () {
	Route::get('/invoices/create', array('as'=>'pagination', 'uses'=>'InvoiceController@create'));
	Route::get('products', array('as'=>'pagination', 'uses'=>'ProductsController@index'));
	Route::post('gotomain', 'HomeController@gotomain');
	Route::post('masterclasses/change_mc_users_status', 'HomeController@change_mc_users_status');
    Voyager::routes();
});
Route::resource('order', 'OrderController');

Route::get('test_test', function(){
    MakingOrder::test();
});

Route::group(['prefix' => '/'], function () {
	Route::get('/', 'HomeController@index');
	Route::get('products', 'HomeController@products');
	Route::post('products/group', 'HomeController@products');
	Route::get('product/{id}', 'HomeController@product');
	Route::get('master_classes', 'HomeController@masterclasses');
	Route::get('news', 'HomeController@news');
	Route::get('news/{id}', 'HomeController@one_news');
	
	Route::get('contacts', function (){
	    return view('contacts.index');
	});
	
	Route::get('one_news', function (){
	    return view('news.one_news');
	});

	Route::get('order', function (){
	    return view('order.index');
	});

	Route::get('about', function (){
	    return view('about_us.index');
	});

	Route::get('payments', function (){
	    return view('payments.index');
	});

	Route::get('main', function (){
	    return view('main.index');
	});

	Route::get('cabinet', 'OrderController@index');

});



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
