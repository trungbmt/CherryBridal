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

//FrontEnd
Route::get('/', 'HomeController@index');


Route::get('/login', ['as'=>'login', 'uses'=>'AuthController@login']);
Route::post('/login-check', 'AuthController@login_check');
Route::get('/logout', 'AuthController@logout');


//BackEnd
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'AdminController@show_dashBoard');


//category product
Route::get('/all-category', 'CategoryProduct@all_category');
Route::get('/add-category', 'CategoryProduct@add_category');
Route::get('/edit-category/{category_id}', 'CategoryProduct@edit_category');
Route::get('/delete-category', 'CategoryProduct@delete_category');


Route::post('/save-category', 'CategoryProduct@save_category');
Route::post('/update-category/{category_id}', 'CategoryProduct@update_category');
Route::get('/unactive-category/{category_id}', 'CategoryProduct@unactive_category');
Route::get('/active-category/{category_id}', 'CategoryProduct@active_category');




//product

Route::get('/add-product', 'ProductController@add_product');
Route::get('/all-product', 'ProductController@all_product');
Route::get('/edit-product/{product_id}', 'ProductController@edit_product');


Route::post('/save-product', 'ProductController@save_product');
Route::post('/update-product/{product_id}', 'ProductController@update_product');
Route::get('/unactive-product/{product_id}', 'ProductController@unactive_product');
Route::get('/active-product/{product_id}', 'ProductController@active_product');
Route::get('/delete-product', 'ProductController@delete_product');

//tag
Route::get('/add-tag', 'TagController@add_tag');
Route::post('/save-tag', 'TagController@save_tag');
Route::get('/all-tag', 'TagController@all_tag');
Route::get('/edit-tag/{tag_id}', 'TagController@edit_tag');
Route::post('/update-tag/{tag_id}', 'TagController@update_tag');
Route::get('/unactive-tag/{tag_id}', 'TagController@unactive_tag');
Route::get('/active-tag/{tag_id}', 'TagController@active_tag');
Route::get('/delete-tag', 'TagController@delete_tag');