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
Route::get('/register', 'AuthController@register');
Route::post('/register-account', 'AuthController@register_account');
Route::get('/logout', 'AuthController@logout');
Route::get('/auth/redirect/{provider}', 'AuthController@redirect')->name('redirect');
Route::get('/callback/{provider}', 'AuthController@callback')->name('callback');



Route::get('/item/{product_id}', 'HomeController@product_detail');
Route::get('/shop', 'HomeController@shop');
Route::get('/shop/{category_id}', 'HomeController@shop_with_category');

Route::get('add-comment', 'CommentController@add_comment');
Route::get('add-reply-comment', 'CommentController@add_reply_comment');

Route::get('/cart', 'HomeController@cart');
Route::get('/cart-total-price', 'HomeController@cart_total_price');
Route::get('/add-to-cart', 'HomeController@add_to_cart');
Route::get('/update-cart', 'HomeController@update_cart');
Route::get('/cart-delete/{cart_id}', 'HomeController@cart_delete');
Route::get('/cart-delete-all', 'HomeController@cart_delete_all');


Route::get('/checkout', 'HomeController@checkout');
Route::post('/checkout-done', 'HomeController@checkout_done');

Route::get('/purchase', 'HomeController@purchase');
Route::get('/order-cancel/{order_id}', 'HomeController@order_cancel');

//rating
Route::get('/get-rating', 'RatingController@get_rating');
Route::post('/post-rating', 'RatingController@add_rating');

//BackEnd
Route::middleware(['auth', 'role:ADMIN'])->group(function () {
	Route::get('/admin', 'ChartController@show');
	Route::get('/chart', 'ChartController@show');
		
	//account

	Route::get('/all-user', 'AccountController@all_user');
	Route::get('/delete-user', 'AccountController@delete_user');
	Route::post('/update-password', 'AccountController@update_password');
	Route::post('/update-role', 'AccountController@update_role');

	//category product
	Route::get('/all-category', 'CategoryController@all_category');
	Route::get('/add-category', 'CategoryController@add_category');
	Route::get('/edit-category/{category_id}', 'CategoryController@edit_category');
	Route::get('/delete-category', 'CategoryController@delete_category');


	Route::post('/save-category', 'CategoryController@save_category');
	Route::post('/update-category/{category_id}', 'CategoryController@update_category');
	Route::get('/unactive-category/{category_id}', 'CategoryController@unactive_category');
	Route::get('/active-category/{category_id}', 'CategoryController@active_category');

	//order
	Route::get('/all-order', 'OrderController@all_order');
	Route::get('/delete-order', 'OrderController@delete_order');
	Route::get('/update-order-status', 'OrderController@update_order_status');

	//comment
	Route::get('/all-comment', 'CommentController@all_comment');
	Route::get('/delete-comment', 'CommentController@delete_comment');

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
});
