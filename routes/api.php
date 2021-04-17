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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('products', 'Api\ProductController@index')->name('products.index');
Route::get('products/{product}', 'Api\ProductController@show')->name('products.show');
Route::post('products', 'Api\ProductController@store')->name('products.store');
Route::put('products/{product}', 'Api\ProductController@update')->name('products.update');
Route::patch('products/{product}', 'Api\ProductController@update')->name('products.update');
Route::delete('products/{product}', 'Api\ProductController@destroy')->name('products.destroy');


Route::apiResource('categories', 'Api\CategoryController');

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');
Route::get('logout', 'Api\AuthController@logout')->middleware('jwtAuth');