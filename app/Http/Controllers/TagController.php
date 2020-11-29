<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;
use App\Tag;
use Session;


class TagController extends Controller
{
    public function add_tag() {
    	return view('admin.add_tag');
    }
    public function save_tag(Request $request) {
        $tag = new Tag();
        $tag->tag_text = $request->tag_text;
        $tag->tag_status = $request->tag_status;

        $tag->save();
    	Session::put('add_tag_message', 'Thêm tag thành công!');
    	return Redirect::to('add-tag');
    }

    public function all_tag() {
    	$all_tag = Tag::paginate(15);
    	return view('admin.all_tag')->with('all_tag', $all_tag);
    }

    public function edit_tag($tag_id) {
        $tag = Tag::find($tag_id);
    	return view('admin.edit_tag')->with('tag',$tag);
    }
    public function update_tag($tag_id, Request $request) {

        $tag = Tag::find($tag_id);
        $tag->tag_text = $request->tag_text;
        $tag->save();
		Session::put('update_tag_message', 'Cập nhật tag thành công!');
    	return Redirect::to('all-tag');
    }

    public function delete_tag(Request $request) {
    	$result = Tag::find($request->get('tag_id'))->delete();
        if($result) return true;
        return false;
    }

    public function unactive_tag($tag_id) {
        $tag = Tag::find($tag_id);
        $tag->tag_status = 0;
        $tag->save();
    	return Redirect::to('all-tag');
    }

    public function active_tag($tag_id) {
        $tag = Tag::find($tag_id);
        $tag->tag_status = 1;
        $tag->save();
    	return Redirect::to('all-tag');
    	
    }
}
