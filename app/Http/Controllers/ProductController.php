<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
use Storage;

class ProductController extends Controller
{
    public function add_product() {
    	$all_category = DB::table('tbl_category')->select('category_id', 'category_name')->get();
    	$all_tag = DB::table('tbl_tag')->get();
    	return view('admin.add_product')->with('all_category', $all_category)->with('all_tag', $all_tag);
    }


    public function all_product() {
    	$all_category = DB::table('tbl_category')->get();
    	return view('admin.all_category')->with('all_category', $all_category);
    }


    public function save_product(Request $request) {

    	$data = array();

    	$data['product_name'] = $request->category_name;
    	$data['product_desc'] = $request->category_desc;
    	$data['product_status'] = $request->category_status;
		if($request->hasFile('product_img')) {
			$path = $request->file('product_img')->store('product_image');
		} else {
			$path = 'product_img/default.png';
		}

		$data['product_img'] = $path;

    	DB::table('tbl_product')->insert($data);
    	Session::put('add_product_message', 'Thêm sản phẩm thành công!');
    	return Redirect::to('add-product');
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
