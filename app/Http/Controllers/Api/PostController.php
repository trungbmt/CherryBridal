<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Response;
use App\User;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(15);
        foreach ($posts as &$post) {
            $post->poster = $post->user();
        }
        return response()->json($posts, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::guard('api')->check()) {
            $user = Auth::guard('api')->user();
            $post = new Post();
            $post->description = $request->description;
            $post->user_id = $user->id;
            if($request->hasFile('media')) 
            {
                $path = $request->file('media')->store('post_media');
                $post->media = $path;
                $post->save();

                return response()->json([
                    'success' => true,
                    'post' => $post,
                    'message' => 'Đăng post thành công!'
                ]);
            } 
            else 
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy file!'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng đăng nhập!'
            ]);
        }
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
