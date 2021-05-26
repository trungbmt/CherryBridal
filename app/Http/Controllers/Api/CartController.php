<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth; 
use App\Cart;
use App\User;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::guard('api')->user();
        $carts = $user->carts()->get();
        $cost = $user->total_cart_money();
        foreach ($carts as &$cart) {
            $cart->product = $cart->product();
            $cart->product_detail = $cart->get_product_detail();
        }
        return response()->json([
            'carts' => $carts,
            'cost' => $cost
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::guard('api')->user();
        $exist_cart = Cart::where([
            'user_id'=> $user->id, 
            'product_id' => $request->product_id, 
            'detail_id' => $request->detail_id,
        ])->first();
        if(!empty($exist_cart)) {
            $exist_cart->amount += $request->amount;
            $exist_cart->save();
        } else {

            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->product_id = $request->product_id;
            $cart->detail_id = $request->detail_id;
            $cart->amount = $request->amount;
            $cart->save();
        }
        return response()->json([
            'success' => true,
            'message' => 'Thêm vào giỏ hàng thành công!'
        ], Response::HTTP_OK);
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
        $user = Auth::guard('api')->user();
        $cart = Cart::find($id);
        if($user->id==$cart->user_id) {
            if($cart->delete()) {
                $newCost = $user->total_cart_money();
                return response()->json([
                    'success' => true,
                    'message' => 'Xoá khỏi giỏ hàng thành công!',
                    'cost' => $newCost
                ], Response::HTTP_OK);
            }
        }
        return response()->json([
            'success' => false,
            'message' => 'Không hợp lệ: '+$id
        ], Response::HTTP_OK);
    }
}
