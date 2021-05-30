<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;
use App\Post_Comment;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    public function withPost($id) {
        $comments = Post::find($id)->comments()->orderBy('created_at', 'desc')->get();
        foreach($comments as $comment) {
            $comment->user = $comment->user();
            $comment->repliesNum = $comment->replies()->count();
        }
        return response()->json([
            'success' => true,
            'comments' => $comments
        ], 200);
    }
    public function store($id, Request $request)
    {
        $user = Auth::guard('api')->user();
        $comment = new Post_Comment();
        $comment->content = $request->content;
        if($request->reply_id) {
            $comment->reply_id = $request->reply_id;
        }
        $comment->post_id = $id;
        $comment->user_id = $user->id;
        if($comment->save()) {
            $comment->user = $comment->user();
            $comment->repliesNum = $comment->replies()->count();
            return response()->json($comment, 200);
        }
        return response('Thất bại', 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
