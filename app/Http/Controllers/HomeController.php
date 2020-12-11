<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

class HomeController extends Controller
{
    public function index() {
    	$all_category = Category::get();
    	return view('user.index')->with('all_category', $all_category);
    }





    public function product_detail($product_id) {
        $product = Product::find($product_id);
        $category = $product->category()->first();
        $related_products = $category->products()->where('product_id', '!=', $product->product_id)->inRandomOrder()->take(4)->get();

        
        return view('user.product-details')
        ->with('product', $product)
        ->with('category', $category)
        ->with('related_products', $related_products);
    }

    public function shop(Request $request) {
        $all_category = Category::get();
        $item_per_page = 12;
        if($request->IPP) $item_per_page = $request->IPP;

        $all_product = Product::where('product_status', 1);
        $recommend_products = Product::inRandomOrder()->limit(3)->get();

        if($request->orderby) {
            $orderby = $request->orderby;
            switch ($orderby) {
                case 'newest':
                    $all_product->orderBy('product_id', 'DESC');
                    break;
                case 'oldest':
                    $all_product->orderBy('product_id', 'ASC');
                    break;
                case 'priceasc':
                    $all_product->join('tbl_product_detail', 'tbl_product_detail.product_id','=','tbl_product.product_id')->orderBy('product_price', 'ASC');
                    break;
                case 'pricedesc':
                    $all_product->join('tbl_product_detail', 'tbl_product_detail.product_id','=','tbl_product.product_id')->orderBy('product_price', 'DESC');
                    break;
            }
        }

        $all_product = $all_product->paginate($item_per_page);
        return view('user.shop')
        ->with('all_category', $all_category)
        ->with('all_product', $all_product)
        ->with('recommend_products', $recommend_products);
    }
    public function shop_with_category(Request $request, $category) {
        $all_category = Category::get();
        $item_per_page = 12;
        if($request->IPP) $item_per_page = $request->IPP;

        $all_product = Category::find($category)->products()->where('product_status', 1);
        $recommend_products = Category::find($category)->products()->inRandomOrder()->limit(3)->get();

        
        if($request->orderby) {
            $orderby = $request->orderby;
            switch ($orderby) {
                case 'newest':
                    $all_product->orderBy('product_id', 'DESC');
                    break;
                case 'oldest':
                    $all_product->orderBy('product_id', 'ASC');
                    break;
                case 'priceasc':
                    $all_product->join('tbl_product_detail', 'tbl_product_detail.product_id','=','tbl_product.product_id')->orderBy('product_price', 'ASC');
                    break;
                case 'pricedesc':
                    $all_product->join('tbl_product_detail', 'tbl_product_detail.product_id','=','tbl_product.product_id')->orderBy('product_price', 'DESC');
                    break;
            }
        }


        $all_product = $all_product->paginate($item_per_page);
        return view('user.shop')
        ->with('all_category', $all_category)
        ->with('all_product', $all_product)
        ->with('recommend_products', $recommend_products);
    }
}
