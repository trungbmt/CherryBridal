<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;
use Session;


class TagController extends Controller
{
    public function add_tag() {
    	return view('admin.add_tag');
    }
    public function save_tag(Request $request) {
    	$data = array();

    	$data['tag_text'] = $request->tag_text;
    	$data['tag_status'] = $request->tag_status;

    	DB::table('tbl_tag')->insert($data);
    	Session::put('add_tag_message', 'Thêm tag thành công!');
    	return Redirect::to('add-tag');
    }

    public function all_tag() {
    	$all_tag = DB::table('tbl_tag')->get();
    	return view('admin.all_tag')->with('all_tag', $all_tag);
    }

    public function edit_tag($tag_id) {
    	$tag = DB::table('tbl_tag')->where('tag_id', $tag_id)->first();
    	return view('admin.edit_tag')->with('tag',$tag);
    }
    public function update_tag($tag_id, Request $request) {

    	$data = array();
		$data['tag_text'] = $request->tag_text;
		DB::table('tbl_tag')->where('tag_id', $tag_id)->update($data);
		Session::put('update_tag_message', 'Cập nhật tag thành công!');
    	return Redirect::to('all-tag');
    }

    public function delete_tag(Request $request) {
    	DB::table('tbl_tag')->where('tag_id', $request->get('tag_id'))->delete();
    	return true;
    }

    public function unactive_tag($tag_id) {
    	DB::table('tbl_tag')->where('tag_id', $tag_id)->update(['tag_status'=>0]);
    	return Redirect::to('all-tag');
    }

    public function active_tag($tag_id) {

    	DB::table('tbl_tag')->where('tag_id', $tag_id)->update(['tag_status'=>1]);
    	return Redirect::to('all-tag');
    	
    }
}
