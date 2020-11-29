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
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:ADMIN');
    }
    public function show_dashBoard() {
    	return view('admin.dashboard');
    }
}
