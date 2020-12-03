<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class HomeController extends Controller
{
    public function index() {
    	$all_category = Category::get();
    	return view('user.index')->with('all_category', $all_category);
    }
}
