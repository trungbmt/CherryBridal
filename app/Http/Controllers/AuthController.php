<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\User;

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
}
