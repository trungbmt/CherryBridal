<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\User;
use Socialite;


class AuthController extends Controller
{
	public function login() {
		if(!Auth::check()) {
			return view('login');
		}
		return Redirect::to('/');
	}
	public function logout() {
		Auth::logout();
		return Redirect::to('login');
	}
	public function register() {
		return view('register');
	}
	public function register_account(Request $request) {
		if(User::where('email', $request->email)->count()!=0) {
			return Redirect::to('register')->with('failed_register_message', 'Địa chỉ email đã tồn tại!');
		}
		else if(User::where('username', $request->username)->count()!=0) 
		{
			return Redirect::to('register')->with('failed_register_message', 'Tên tài khoản đã tồn tại!');
		}
		$user = new User();
		$user->username = $request['username'];
		$user->email = $request['email'];
		$user->password = Hash::make($request['password']);
		$user->role = 'MEMBER';
		$user->save();
		
		Auth::logout();
    	Auth::attempt([
    		'username'=>$request['username'],
    		'password'=>$request['password']
    	]); 
    	return Redirect::to(url()->previous());


	}
    public function login_check(Request $request) {
    	$username = $request['username'];
    	$password = $request['password'];
    	if(Auth::attempt([
    		'username'=>$username,
    		'password'=>$password
    	])) return Redirect::to(url()->previous());
    	return Redirect::to('login')->with('failed_login_message', 'Tài khoản hoặc mật khẩu không chính xác!');
    }
    public function redirect($provider)
	{
	    return Socialite::driver($provider)->redirect();
	}
	public function callback($provider)
	{
	  	$getInfo = Socialite::driver($provider)->user(); 
	  	$user = User::where('provider_id', $getInfo->id)->first();
	  	if (!$user) 
	  	{
			if(!User::where('email', $getInfo->email)->count()!=0) {

				$user = $this->createUser($getInfo,$provider); 
			} 
			else {
				
				return Redirect::to('login')->with('failed_login_message', 'Địa chỉ email đã được đăng ký!'); 
			}
	  	}

		auth()->login($user);
		return Redirect::to('/');
	 	
    	
    }
	function createUser($getInfo,$provider){

    	$user = User::create([
	        'username'     => $getInfo->name,
	        'email'    => $getInfo->email,
	        'provider' => $provider,
	        'provider_id' => $getInfo->id,
	        'role' => 'MEMBER'
    	]);
	 	return $user;
	}
}
