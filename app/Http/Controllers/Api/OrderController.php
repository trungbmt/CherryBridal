<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth; 
use App\Order;
use App\Order_Item;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::guard('api')->user();
        $orders = $user->orders()->with('items_api')->orderBy('created_at', 'desc')->get();
        $result = $orders;
        return response()->json([
            'orders' => $result
        ], Response::HTTP_OK);
    }
    public function abort($id) {
        $user = Auth::guard('api')->user();
        $order = Order::find($id);
        if($user->id==$order->user_id) {
            $order->order_status = -1;
            $order->save();
            return response()->json([
                'success' => true
            ], Response::HTTP_OK);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
