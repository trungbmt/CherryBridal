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
    	Session::put('add_category_message', 'Thêm danh mục thành công!');
    	return Redirect::to('add-category');
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
    	$view_editCategory = view('admin.edit_category')->with('category', $category);
    	return view('admin.admin_layout')->with('admin.edit_category', $view_editCategory);

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
