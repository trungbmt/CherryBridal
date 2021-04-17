<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request) {
        return response()->json([
            'success' => true,
            'user' => User::find(Auth::user()->id)
        ]);
        // try{

        //     JWTAuth::invalidate(JWTAuth::parseToken($request->token));
        //     return response()->json([
        //         'success' => true,
        //         'message' => 'Đăng xuất thành công!'
        //     ]);
        // } catch(Excepsion $e) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => ''.$e
        //     ]);
        // }
    }
    public function login(Request $request) {
        $creds = $request->only(['username', 'password']);
        $token=Auth::attempt($creds);
        if(!$token){
            return response()->json([
                'success' => false,
                'message' => 'Sai tài khoản hoặc mật khẩu!'
            ]);
        }
        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => Auth::User()
        ]);

    }

    public function register(Request $request) {

        $validated = $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);
        try {

            $user = User::create([
                'username' => $request['username'],
                'password' => bcrypt($request['password']),
                'email' => $request['email'],
                'role' => 'MEMBER'
            ]);

            $token=Auth::attempt([
                "username" => $user->username,
                "password" => $request->password
            ]);

            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => $user
            ]);

        } catch(Excepsion $e) {
            return response()->json([
                'success' => false,
                'message' => ''.$e
            ]);

        }

    }
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

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
