<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Socialite;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function socialite_login(Request $request) {
        $provider = $request->provider;
        $token = $request->access_token;
        if($provider=='google') {
            $getInfo = Http::get('https://oauth2.googleapis.com/tokeninfo', [
                'id_token' => $token
            ]);
            $user_id = $getInfo['sub'];
            $user_email = $getInfo['email'];
        } else {

            $getInfo = Socialite::driver($provider)->userFromToken($token);
            $user_id = $getInfo->id;
            $user_email = $getInfo->email;
            if(!$user_email) $getInfo->email = "";
        }
        $user = User::where('provider_id', $user_id)->first();
        if(!$user) {
            if(!User::where('email', $user_email)->count()!=0) {
                $user = $this->createUser($getInfo,$provider,$token); 
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Email đã đăng ký với phương thức đăng nhập khác!'
                ]);
            }
        } else if($provider=='google') {
            $user->avatar = $getInfo['picture'];
            $user->save();
        } else {
            $user->avatar = $getInfo->avatar."&access_token=".$token;
            $user->save();
        }       
        $token = Auth::guard('api')->login($user);
        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user
        ]);

    }
    function createUser($getInfo,$provider,$token){
        if($provider=='google') {
            $avatar = $getInfo['picture'];
        } else {
            $avatar = $getInfo->avatar."&access_token=".$token;
        }
        $user = User::create([
            'username'     => $getInfo->name,
            'email'    => $getInfo->email,
            'avatar' => $avatar,
            'provider' => $provider,
            'provider_id' => $getInfo->id,
            'role' => 'MEMBER'
        ]);
        return $user;
    }

    public function logout(Request $request) {
        try{

            $user = User::find(Auth::guard('api')->user());
            JWTAuth::invalidate(JWTAuth::parseToken($request->token));
            return response()->json([
                'success' => true,
                'user' => $user,
                'message' => 'Đăng xuất thành công!'
            ]);
        } catch(Excepsion $e) {
            return response()->json([
                'success' => false,
                'message' => ''.$e
            ]);
        }
    }
    public function tokenCheck(Request $request) {
        $user = User::find(Auth::guard('api')->user());
        if($user) {
            return response()->json([
                'success' => true,
                'user' => $user,
                'message' => 'Token hợp lệ!'
            ], 202);
        }
        return response()->json([
            'success' => false,
            'message' => 'Token không hợp lệ!'
        ], 401);
    }
    public function login(Request $request) {
        $creds = $request->only(['username', 'password']);
        $token=Auth::guard('api')->attempt($creds);
        if(!$token){
            return response()->json([
                'success' => false,
                'message' => 'Sai tài khoản hoặc mật khẩu!'
            ]);
        }
        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => Auth::guard('api')->user()
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

            $token=Auth::guard('api')->attempt([
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
