<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Category;
use App\Product;
use App\Cart;
use App\Order;
use App\Order_Item;
use Illuminate\Support\Facades\Auth; 

class HomeController extends Controller
{
    public function index() {
    	$all_category = Category::get();
        $all_cart = null;
        if(Auth::check()) 
        {
            $all_cart= Auth::User()->carts()->get();
        }
    	return view('user.index')->with('all_category', $all_category)->with('all_cart', $all_cart);
    }

//======================================={cart}========================================

    public function cart() {
        if(!Auth::check()) 
        {
            return Redirect::to('login');
        } 
        $all_category = Category::get();
        $all_cart = Auth::User()->carts()->get();


        return view('user.cart')
        ->with('all_category', $all_category)
        ->with('all_cart', $all_cart);
    }
    public function cart_total_price() {
        if(Auth::check()) {
            return Auth::User()->total_cart_money_formated();
        }
        return false;
    }
    public function add_to_cart(Request $request) {
        if(!Auth::check()) 
        {
            return false;
        }
        $user_id= Auth::User()->id;
        $exist_cart = Cart::where([
            'user_id'=> $user_id, 
            'product_id' => $request->product_id, 
            'detail_id' => $request->detail_id,
        ])->first();
        if(!empty($exist_cart)) {
            $exist_cart->amount += $request->amount;
            $exist_cart->save();
        } else {

            $cart = new Cart();
            $cart->user_id = Auth::User()->id;
            $cart->product_id = $request->product_id;
            $cart->detail_id = $request->detail_id;
            $cart->amount = $request->amount;
            $cart->save();
        }
        return true;

    }
    public function update_cart(Request $request) {
        $cart = Auth::User()->carts()->find($request->cart_id);
        $cart->amount = $request->amount;
        $cart->save();
        return $cart->price_format($cart->get_total_price());
    }
    public function cart_delete($cart_id) {
        $cart = Auth::User()->carts()->find($cart_id);
        $cart->delete();
        return Redirect::to('/cart/');
    }
    public function cart_delete_all() {
        $all_cart = Auth::User()->carts();
        $all_cart->delete();
        return Redirect::to('/cart/');
    }
//======================================={checkout}========================================
    public function checkout() {
        if(!Auth::check()) 
        {
            return Redirect::to('login');
        } 
        $all_category = Category::get();
        $all_cart = Auth::User()->carts()->get();
        return view('user.checkout')
        ->with('all_category', $all_category)
        ->with('all_cart', $all_cart);
    }
    public function checkout_done(Request $request) {
        if(!Auth::check()) 
        {
            return Redirect::to('login');
        } 
        $all_cart = Auth::User()->carts()->get();

        $order = new Order();
        $order->user_id = Auth::User()->id;
        $order->order_full_name =  $request->order_full_name;
        $order->order_phone = $request->order_phone;
        $order->order_city = $request->order_city;
        $order->order_province = $request->order_province;
        $order->order_address = $request->order_address;
        $order->order_status = 0;
        $order->save();

        foreach ($all_cart as $cart) {
            $cart->cart_to_order($order->order_id);
        }

        return Redirect::to('/purchase/');
    }
//======================================={purchase}========================================
    public function purchase() {
        if(!Auth::check()) 
        {
            return Redirect::to('login');
        } 
        $all_category = Category::get();
        $all_cart = Auth::User()->carts()->get();


        $all_order = Auth::User()->orders;
        return view('user.purchase')
        ->with('all_order', $all_order)
        ->with('all_category', $all_category)
        ->with('all_cart', $all_cart);
    }
    public function order_cancel($order_id) {
        if(!Auth::check()) 
        {
            return Redirect::to('login');
        } 
        $order = Order::find($order_id);
        if($order->user_id == Auth::User()->id) 
        {
            $order->order_status = -1;
        }
        $order->save();
        return Redirect::to('/purchase');   
    }
//======================================={product}========================================

    public function product_detail($product_id) {
        $product = Product::find($product_id);
        $category = $product->category()->first();
        $related_products = $category->products()->where('product_id', '!=', $product->product_id)->inRandomOrder()->take(4)->get();

        $all_category = Category::get();
        $all_cart = null;
        if(Auth::check()) 
        {
            $all_cart= Auth::User()->carts()->get();
        }
        
        return view('user.product-details')
        ->with('product', $product)
        ->with('category', $category)
        ->with('related_products', $related_products)
        ->with('all_category', $all_category)
        ->with('all_cart', $all_cart);
    }

//======================================={category}========================================
    public function shop(Request $request) {
        $all_category = Category::get();
        $all_cart = null;
        if(Auth::check()) 
        {
            $all_cart= Auth::User()->carts()->get();
        }

        $item_per_page = 12;

        if($request->view) {
            $view = $request->view;
            switch ($view) {
                case 'small':
                    $item_per_page = 6;
                    break;
                case 'normal':
                    $item_per_page = 12;
                    break;
                case 'large':
                    $item_per_page = 24;
                    break;
            }
        }

        $all_product = Product::query()->price($request)->name($request)->where('product_status', 1);
        $recommend_products = Product::inRandomOrder()->limit(3)->get();

        if($request->orderby) {
            $orderby = $request->orderby;
            switch ($orderby) {
                case 'newest':
                    $all_product->orderBy('tbl_product.product_id', 'DESC');
                    break;
                case 'oldest':
                    $all_product->orderBy('tbl_product.product_id', 'ASC');
                    break;
                case 'priceasc':
                    $all_product->orderBy('tbl_product_detail.product_price', 'ASC');
                    break;
                case 'pricedesc':
                    $all_product->orderBy('tbl_product_detail.product_price', 'DESC');
                    break;
            }
        }
        $all_product = $all_product->groupBy('tbl_product.product_id')->paginate($item_per_page)->withQueryString();
        return view('user.shop')
        ->with('all_category', $all_category)
        ->with('all_cart', $all_cart)
        ->with('all_product', $all_product)
        ->with('recommend_products', $recommend_products)
        ->with('current_category_id', 0);
    }
    public function shop_with_category(Request $request, $category) {
        $all_category = Category::get();
        $all_cart = null;
        if(Auth::check()) 
        {
            $all_cart= Auth::User()->carts()->get();
        }

        $item_per_page = 12;
        
        if($request->view) {
            $view = $request->view;
            switch ($view) {
                case 'small':
                    $item_per_page = 6;
                    break;
                case 'normal':
                    $item_per_page = 12;
                    break;
                case 'large':
                    $item_per_page = 24;
                    break;
            }
        }

        $all_product = Category::find($category)->products()->price($request)->name($request)->where('product_status', 1);
        $recommend_products = Category::find($category)->products()->inRandomOrder()->limit(3)->get();

        
        if($request->orderby) {
            $orderby = $request->orderby;
            switch ($orderby) {
                case 'newest':
                    $all_product->orderBy('tbl_product.product_id', 'DESC');
                    break;
                case 'oldest':
                    $all_product->orderBy('tbl_product.product_id', 'ASC');
                    break;
                case 'priceasc':
                    $all_product->orderBy('tbl_product_detail.product_price', 'ASC');
                    break;
                case 'pricedesc':
                    $all_product->orderBy('tbl_product_detail.product_price', 'DESC');
                    break;
            }
        }


        $all_product = $all_product->groupBy('tbl_product.product_id')->paginate($item_per_page)->withQueryString();
        return view('user.shop')
        ->with('all_category', $all_category)
        ->with('all_cart', $all_cart)
        ->with('all_product', $all_product)
        ->with('recommend_products', $recommend_products)
        ->with('current_category_id', $category);
    }
}
