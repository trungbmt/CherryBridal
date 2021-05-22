<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('jwtAuth')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('products', 'Api\ProductController@index')->name('products.index');
Route::get('products/{product}', 'Api\ProductController@show')->name('products.show');
Route::post('products', 'Api\ProductController@store')->name('products.store');
Route::put('products/{product}', 'Api\ProductController@update')->name('products.update');
Route::patch('products/{product}', 'Api\ProductController@update')->name('products.update');
Route::delete('products/{product}', 'Api\ProductController@destroy')->name('products.destroy');

Route::get('posts', 'Api\PostController@index')->name('posts.index');
Route::post('posts', 'Api\PostController@store')->name('posts.store');
Route::post('posts/like', 'Api\PostController@like_post')->name('posts.like_post')->middleware('jwtAuth');

Route::post('carts', 'Api\CartController@store')->name('carts.store')->middleware('jwtAuth');
Route::get('carts', 'Api\CartController@index')->name('carts.index')->middleware('jwtAuth');



Route::apiResource('categories', 'Api\CategoryController');

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');
Route::get('logout', 'Api\AuthController@logout')->middleware('jwtAuth');

Route::post('socialite-login', 'Api\AuthController@socialite_login');