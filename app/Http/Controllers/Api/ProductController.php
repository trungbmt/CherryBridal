<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth; 

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::name($request)->category($request)->orderBy('created_at', 'desc')->paginate(15);
        foreach ($products as $product) {
            $product->lowest_price = $product->get_lowest_price2();
        }
        return response()->json($products, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Product::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produc  $produc
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->product_details = $product->details()->get();
        $product->rating_value = $product->rating_value();
        return response()->json($product, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produc  $produc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        return $product->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produc  $produc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }

    public function add_rating(Request $request) {
        $user = Auth::guard('api')->user();
        $product_id = $request->product_id;
        if($user->isBought($product_id)) 
        {
            if($request->value>5 || $request->value<0) 
            {
                return response(-1, 401);
            }
            $rating = $user->get_rating($product_id)->first();
            if(!$rating) {
                $rating = new Rating();
                $rating->product_id = $product_id;
                $rating->user_id = $user->id;
            }
            $rating->value = $request->value;
            $rating->content = $request->content;
            $rating->save();
        } else
        {
            return response(-1, 401);
        }
        return response(Product::find($product_id)->rating_value(), 200);
    }
}
