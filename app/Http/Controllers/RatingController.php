<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Rating;
use App\Product;

class RatingController extends Controller
{	
	public function get_rating(Request $request) {
		$all_rating = Product::find($request->product_id)->rates()->join('users', 'users.id','=','tbl_rating.user_id')->select('tbl_rating.*', 'users.username')->get();
		return $all_rating;
	}


    public function add_rating(Request $request) {
        if(!Auth::check()) 
        {
            return response('Bạn chưa đăng nhập!', 401);
        }
        $product_id = $request->product_id;
        if(Auth::User()->isBought($product_id)) 
        {
        	if($request->value>5 || $request->value<0) 
        	{
        		return response('Đánh giá không hợp lệ!', 401);
        	}
        	$rating = Auth::User()->get_rating($product_id)->first();
        	if(!$rating) {
        		$rating = new Rating();
	        	$rating->product_id = $product_id;
	        	$rating->user_id = Auth::User()->id;
        	}
        	$rating->value = $request->value;
        	$rating->content = $request->content;
        	$rating->save();
        } else
        {
        	return response('Bạn chưa mua sản phẩm này!', 401);
        }
    	return response('Đánh giá thành công!', 200);
    }
    
}
