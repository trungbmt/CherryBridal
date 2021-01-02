<?php

namespace App\Http\Controllers;
use App\Category;
use App\Tag;
use App\Product;
use App\Product_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
use Storage;

class ProductController extends Controller
{
    public function add_product() {
        $all_category = Category::all();
        $all_tag = Tag::all();
    	return view('admin.add_product')->with('all_category', $all_category)->with('all_tag', $all_tag);
    }


    public function all_product(Request $request) {
    	$all_product = Product::name($request)->category($request)->paginate(15);
        $all_category = Category::all();
    	return view('admin.all_product')
        ->with('all_product', $all_product)
        ->with('all_category', $all_category);
    }


    public function save_product(Request $request) {

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_category = $request->product_category;
        $product->product_desc = $request->product_desc;
        $product->product_status = $request->product_status;
        $product->product_tag = $request->product_tag;

		if($request->hasFile('product_img')) {
			$path = $request->file('product_img')->store('product_image');
		} else {
			$path = 'product_img/default.png';
		}

		$product->product_img = $path;
    	$product->save();

        $numbers= $request->size;
        foreach ($numbers as $number => $size) {
            $product_detail = new Product_Detail();
            $product_detail->product_id = $product->product_id;
            $product_detail->product_price = $request->price[$number]; 
            $product_detail->product_amount = $request->amount[$number]; 
            $product_detail->product_size = $size; 
            $product_detail->save();
        }


    	return Redirect::to('add-product')->with('add_product_message', 'Thêm sản phẩm thành công!');
    }

    public function update_product(Request $request, $product_id) {

        $product = Product::find($product_id);
        $product->product_name = $request->product_name;
        $product->product_desc = $request->product_desc;
        $product->product_tag = $request->product_tag;
        $product->product_category = $request->product_category;

		if($request->hasFile('product_img')) {
			$product->product_img = $request->file('product_img')->store('product_img');
		}
        $product->save();
        $product->details()->delete();

        $numbers= $request->size;
        foreach ($numbers as $number => $size) {
            $product_detail = new Product_Detail();
            $product_detail->product_id = $product->product_id;
            $product_detail->product_price = $request->price[$number]; 
            $product_detail->product_amount = $request->amount[$number]; 
            $product_detail->product_size = $size; 
            $product_detail->save();
        }

		Session::put('update_product_message', 'Cập nhật sản phẩm thành công!');
    	return Redirect::to('all-product');
    }

    public function edit_product($product_id) {;
        $product = Product::find($product_id);
        $all_category = Category::all();
        $all_tag = Tag::all();
        $details = $product->details()->get();
        return view('admin.edit_product')->with('product',$product)->with('all_category' ,$all_category)->with('all_tag', $all_tag)->with('details', $details);

    }
    public function delete_product(Request $request) {
        $result = Product::find($request->get('product_id'))->delete();
        if($result) return true;
        return false;
    }

    public function unactive_product($product_id) {
        $product = Product::find($product_id);
        $product->product_status = 0;
        $product->save();
        return Redirect::to('all-product');
    }

    public function active_product($product_id) {
        $product = Product::find($product_id);
        $product->product_status = 1;
        $product->save();
    	return Redirect::to('all-product');
    	
    }
}
