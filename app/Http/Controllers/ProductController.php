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


    public function all_product() {
    	$all_category = DB::table('tbl_category')->get();
    	return view('admin.all_category')->with('all_category', $all_category);
    }


    public function save_product(Request $request) {

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_category = $request->product_category;
        $product->product_desc = $request->product_desc;
        $product->product_status = $request->product_status;
        $product->product_tag = $request->product_tag;

        if(!$product->product_tag) $product->product_tag="0";
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

    public function update_category(Request $request, $category_id) {


    	$data = array();

    	$data['category_name'] = $request->category_name;
    	$data['category_desc'] = $request->category_desc;
		if($request->hasFile('category_img')) {
			$data['category_img'] = $request->file('category_img')->store('category_image');
		}
		DB::table('tbl_category')->where('category_id', $category_id)->update($data);
		Session::put('update_category_message', 'Cập nhật danh mục thành công!');
    	return Redirect::to('all-category');
    }

    public function edit_category($category_id) {
    	$category = DB::table('tbl_category')->where('category_id', $category_id)->first();
    	return view('admin.edit_category')->with('category',$category);

    }
    public function delete_category(Request $request) {
    	DB::table('tbl_category')->where('category_id', $request->get('category_id'))->delete();
    	return true;
    }

    public function unactive_category($category_id) {
    	DB::table('tbl_category')->where('category_id', $category_id)->update(['category_status'=>0]);
    	return Redirect::to('all-category');
    }

    public function active_category($category_id) {

    	DB::table('tbl_category')->where('category_id', $category_id)->update(['category_status'=>1]);
    	return Redirect::to('all-category');
    	
    }
}
