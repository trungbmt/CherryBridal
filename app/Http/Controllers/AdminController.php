<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
session_start();


class AdminController extends Controller
{
    public function index() {
    	return view('admin.login');
    }
    public function show_dashBoard() {
    	return view('admin.dashboard');
    }
    public function login_check(Request $request) {
    	$admin_email = $request->admin_email;
    	$admin_password = md5($request->admin_password);

    	$result = DB::table('table_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
    	if($result) {
    		Session::put('admin_id',$result->admin_id);
    		Session::put('admin_name',$result->admin_name);
    		return Redirect::to('/dashboard');
    	} else {
    		Session::put('failed_login_message', 'Mật khẩu hoặc tài khoản không đúng!');
    		return Redirect::to('/admin');
    	}
    }

    public function logout() {
        Session::put('admin_id', null);
        Session::put('admin_name', null);
        return Redirect::to('/admin');
    }
}
