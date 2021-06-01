<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Response;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function avatar_change(Request $request) {
        $user = Auth::guard('api')->user();
        if($request->hasFile('avatar')) 
        {
            $path = $request->file('avatar')->store('user_avatar');
            $user->avatar = $path;
            $user->save();
            return response()->json([
                'success' => true,
                'avatar' => $user->avatar,
                'message' => 'Thay ảnh đại diện thành công!'
            ]);
        }
        return response()->json([
            'success' => false,
            'avatar' => $user->avatar,
            'message' => 'Thay ảnh đại diện thất bại!'
        ]);
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
