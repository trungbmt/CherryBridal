<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Order;

class OrderController extends Controller
{
    public function all_order(Request $request){
    	if($request->status&&$request->status!=2) 
    	{
    		$all_order = Order::where('order_status', $request->status)->paginate(15);
    	} else {

    		$all_order = Order::paginate(15);
    	}
    	return view('admin.all_order')->with('all_order', $all_order);
    }
    public function update_order_status(Request $request){
    	$order = Order::find($request->order_id);
    	$order->order_status = $request->order_status;
    	$order->save();
    	return true;
    }
    public function delete_order(Request $request) {
    	$order = Order::find($request->order_id);
    	$order->delete();
    	return true;
    }
}
