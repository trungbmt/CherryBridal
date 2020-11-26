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

//category product
Route::get('add-category', 'CategoryProduct@add_category');
Route::get('all-category', 'CategoryProduct@all_category');
Route::post('save-category', 'CategoryProduct@save_category');