<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\User;
use App\Post;
use App\Post_Comment;
use App\Like_Comment;

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
    public function like_comment(Request $request) {
        $user = Auth::guard('api')->user();
        $comment = Post_Comment::find($request->comment_id);

        $like = Like_Comment::where([
            'user_id' => $user->id, 
            'comment_id' => $request->comment_id
        ])->first();

        if($like) {
            $like->delete();
            return response()->json([
                'success' => true,
                'likesNum' => $comment->likes()->count(),
                'like' => false
            ], Response::HTTP_OK);
        }

        $like = new Like_Comment();
        $like->user_id = $user->id;
        $like->comment_id = $comment->id;
        $like->save();
        return response()->json([
            'success' => true,
            'likesNum' => $comment->likes()->count(),
            'like' => true
        ], Response::HTTP_OK);
    }
    public function withPost($id) {
        $comments = Post::find($id)->comments()->orderBy('created_at', 'desc')->get();
        $user = Auth::guard('api')->user();
        foreach($comments as $comment) {
            $comment->user = $comment->user();
            $comment->repliesNum = $comment->replies()->count();
            $comment->likesNum = $comment->likes()->count();
            if($user) {
                $liked = $user->likedPostComment($comment->id);
                $comment->liked = $liked;
            }
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
    public function reply($id, Request $request) {
        $user = Auth::guard('api')->user();
        $comment = Post_Comment::find($id);
        if($comment) {
            $reply_comment = new Post_Comment();
            $reply_comment->content = $request->content;
            $reply_comment->post_id = $request->post_id;
            $reply_comment->user_id = $user->id;
            $reply_comment->reply_id = $comment->id;
            if($reply_comment->save()) {
                return response()->json($reply_comment, 200);
            }
        }
        return response()->json('Thất bại', 400);
    }
    public function replies($id, Request $request) {
        $user = Auth::guard('api')->user();
        $comment = Post_Comment::find($id);
        $replies = $comment->replies()->get();
        foreach($replies as $reply) {
            $reply->user = $reply->user();
            $reply->likesNum = $reply->likes()->count();
            if($user) {
                $liked = $user->likedPostComment($reply->id);
                $reply->liked = $liked;
            }
        }
        return response()->json([
            'success' => true,
            'comments' => $replies
        ], 200);
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
