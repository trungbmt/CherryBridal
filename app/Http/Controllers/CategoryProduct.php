<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
use Storage;
use App\Category;

class CategoryProduct extends Controller
{
    public function add_category() {
    	return view('admin.add_category');
    }


    public function all_category() {

        $all_category = Category::paginate(15);
    	return view('admin.all_category')->with('all_category', $all_category);
    }


    public function save_category(Request $request) {

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->category_desc = $request->category_desc;
        $category->category_status = $request->category_status;



		if($request->hasFile('category_img')) {
			$path = $request->file('category_img')->store('category_image');
		} else {
			$path = 'category_img/default.png';
		}

		$category->category_img = $path;
        $category->save();

    	Session::put('add_category_message', 'Thêm danh mục thành công!');
    	return Redirect::to('add-category');
    }

    public function update_category(Request $request, $category_id) {

        $category = Category::find($category_id);

        $category->category_name = $request->category_name;
        $category->category_desc = $request->category_desc;
		if($request->hasFile('category_img')) {
			$category->category_img = $request->file('category_img')->store('category_image');
		}
		$category->save();
		Session::put('update_category_message', 'Cập nhật danh mục thành công!');
    	return Redirect::to('all-category');
    }

    public function edit_category($category_id) {
        $category = Category::find($category_id);
    	return view('admin.edit_category')->with('category',$category);

    }
    public function delete_category(Request $request) {
        $result = Category::find($request->get('category_id'))->delete();
    	if($result) return true;
        return false;
    }

    public function unactive_category($category_id) {
        $category = Category::find($category_id);
        $category->category_status = 0;
        $category->save();
    	return Redirect::to('all-category');
    }

    public function active_category($category_id) {

        $category = Category::find($category_id);
        $category->category_status = 1;
        $category->save();
    	return Redirect::to('all-category');
    	
    }
}
