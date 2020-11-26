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
Route::get('/', function () {
    return view('welcome');
});

Route::get('/trang-chu', function () {
    return view('trangchu');
});


//BackEnd
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'AdminController@show_dashBoard');
Route::get('/logout', 'AdminController@logout');
Route::post('/login-check', 'AdminController@login_check');

Route::get('/all-category', 'CategoryProduct@all_category');

//category product
Route::get('/add-category', 'CategoryProduct@add_category');
Route::get('/edit-category/{category_id}', 'CategoryProduct@edit_category');
Route::get('/delete-category/{category_id}', 'CategoryProduct@delete_category');
Route::get('/delete-category', 'CategoryProduct@delete_category');


Route::post('/save-category', 'CategoryProduct@save_category');
Route::post('/update-category/{category_id}', 'CategoryProduct@update_category');
Route::get('/unactive-category/{category_id}', 'CategoryProduct@unactive_category');
Route::get('/active-category/{category_id}', 'CategoryProduct@active_category');




//imageView