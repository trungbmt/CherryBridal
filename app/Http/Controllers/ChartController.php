<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\User;

class ChartController extends Controller
{
    public function show() {

    	$data = array();
    	for ($i=0; $i < 12; $i++) { 
    		$month_start = date("Y-m-d", mktime(0, 0, 0, date('m')-$i, 1, date('Y')));
    		$month_end = date("Y-m-d", mktime(23, 59, 59, date('m')-$i, date('t', strtotime($month_start)), date('Y')));
    		$month['month'] = date('Y-m', strtotime($month_start));

    		$month['products'] = Product::whereBetween('created_at', [$month_start, $month_end])->count();
    		$month['orders'] = Order::whereBetween('created_at', [$month_start, $month_end])->count();
    		$month['users'] = User::whereBetween('created_at', [$month_start, $month_end])->count();

    		$month['income'] = 0;
    		$orders = Order::whereBetween('created_at', [$month_start, $month_end])->get();
    		foreach($orders as $order) {
    			$month['income']+= $order->price();
    		}
    		echo $month['income'];

    		array_push($data, $month);
    	}


    	return view('admin.chart')
    	->with('list_data', $data);
    }
}
