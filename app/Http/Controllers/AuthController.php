<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Redirect;
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
		$username = $request['username'];
		$email = $request['email'];
		$password = $request['password'];
		


	}
    public function login_check(Request $request) {
    	$username = $request['username'];
    	$password = $request['password'];
    	if(Auth::attempt([
    		'username'=>$username,
    		'password'=>$password
    	])) return Redirect::to('/');
    	return Redirect::to('login')->with('failed_login_message', 'Tài khoản hoặc mật khẩu không chính xác!');
    }
}
