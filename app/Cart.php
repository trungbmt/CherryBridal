<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
    	'user_id',
    	'product_id',
    	'detail_id',
    	'amount',
    ];
    protected $primaryKey = 'cart_id';
    protected $table = 'tbl_cart';

    public function product(){
	    return $this->belongsTo('App\Product', 'product_id')->first();
	}
    public function get_product_detail() {
        return $this->belongsTo('App\Product_Detail', 'detail_id')->first();
    }
    public function get_total_price() {
        $price = $this->get_product_detail()->product_price;
        return $price*$this->amount;
    }
    public static function price_format($arg) {
        return number_format($arg, 0, ',', '.').'đ';
    }
}
