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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/test', 'TestController@index');
