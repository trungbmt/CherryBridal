<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Comment;
use Illuminate\Support\Facades\Auth; 

class CommentController extends Controller
{
    public function add_comment(Request $request) {
        if(!Auth::check()) 
        {
            return null;
        }
    	$comment = new Comment();
    	$comment->content = $request->content;
    	$comment->user_id = Auth::User()->id;
    	$comment->product_id = $request->product_id;
    	$comment->save();
    	return $comment->id;
    }
    public function add_reply_comment(Request $request) {
        if(!Auth::check()) 
        {
            return null;
        }
    	$comment = new Comment();
    	$comment->content = $request->content;
    	$comment->user_id = Auth::User()->id;
    	$comment->product_id = $request->product_id;
    	$comment->reply_id = $request->reply_id;
    	$comment->save();
    	return $comment->id;
    }
}
