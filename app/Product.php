<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'product_category',
    	'product_name',
    	'product_desc',
    	'product_tag',
    	'product_img',
    	'product_status'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';

    public function category(){
        return $this->belongsTo('App\Category', 'product_category');
    }
    public function details(){
        return $this->hasMany('App\Product_Detail', 'product_id', 'product_id');
    }

    public function comments(){
        return $this->hasMany('App\Comment', 'product_id', 'product_id')->whereNull('reply_id')->orderBy('created_at', 'desc');
    }
    public function rates(){
        return $this->hasMany('App\Rating', 'product_id', 'product_id');
    }
    public function rating_value() {
        return $this->rates()->groupBy('product_id')->average('value');
    }

    public function get_lowest_price() {
        $price = $this->hasMany('App\Product_Detail', 'product_id', 'product_id')->orderBy('product_price', 'asc')->first()->product_price;
        return number_format($price, 0, ',', '.').'đ';
    }
    public function get_lowest_price2() {
        $price = $this->hasMany('App\Product_Detail', 'product_id', 'product_id')->orderBy('product_price', 'asc')->first()->product_price;
        return $price;
    }
    public function get_aver_price() {
        return $this::avg('price');
    }
    public function get_total_amount() {
        return $this->details()->sum('product_amount');
    }
    public function get_fake_price() {
        $price = $this->hasMany('App\Product_Detail', 'product_id', 'product_id')->orderBy('product_price', 'asc')->first()->product_price;
        $price+= $price*0.3;
        return number_format($price, 0, ',', '.').'đ';
    }
    public function scopePrice($query, $request) {

        $min_price = 0*1000000;
        $max_price= 20*1000000;
        if($request->min) $min_price = $request->min*1000000;
        if($request->max) $max_price = $request->max*1000000;
        $query->join('tbl_product_detail', 'tbl_product_detail.product_id','=','tbl_product.product_id')->whereBetween('product_price', [$min_price, $max_price]);
        return $query;
    }
    public function scopeName($query, $request) {
        if($request->search) 
            {
                $name = $request->search;
                $query->where('product_name', 'like', '%'.$name.'%');
            }
        return $query;
    }
    public function scopeCategory($query, $request) {
        if($request->category==0) return $query;
        if($request->category) 
        {
            $category = $request->category;
            $query->where('product_category', $category);
        }
        return $query;
    }
}
