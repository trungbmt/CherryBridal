<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
use Storage;

class CategoryProduct extends Controller
{
    public function add_category() {
    	return view('admin.add_category');
    }
    public function all_category() {
    	$all_category = DB::table('tbl_category')->get();
    	$manager_category = view('admin.all_category')->with('all_category', $all_category);
    	return view('admin.admin_layout')->with('admin.all_category', $manager_category);
    }
    public function save_category(Request $request) {

    	$data = array();

    	$data['category_name'] = $request->category_name;
    	$data['category_desc'] = $request->category_desc;
    	$data['category_status'] = $request->category_status;
		if($request->hasFile('category_img')) {
			$path = $request->file('category_img')->store('category_image');
		} else {
			$path = 'category_img/default.png';
		}

		$data['category_img'] = $path;

    	DB::table('tbl_category')->insert($data);
    	Session::put('add_category_message', 'Thêm danh mục sản phẩm thành công!');
    	return Redirect::to('add-category');
    }
}
