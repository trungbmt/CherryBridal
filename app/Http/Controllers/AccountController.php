<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function all_user(Request $request) {
    	$all_user = User::search($request)->paginate(15);
    	return view('admin.all_user')->with('all_user', $all_user);
    }
    public function update_password(Request $request) {
        $user = User::find($request->get('user_id'));
        $user->password = Hash::make($request->password);
        $user->save();
    	return true;
    }
    public function update_role(Request $request) {
        $user = User::find($request->get('user_id'));
        if($request->role==1) $user->role = 'ADMIN';
        else if($request->role==0) $user->role = 'MEMBER';
        $user->save();
    	return true;
    }
    public function delete_user(Request $request) {
        $result = User::find($request->get('user_id'))->delete();
    	if($result) return true;
        return false;
    }
}
