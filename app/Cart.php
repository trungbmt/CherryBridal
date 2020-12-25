<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Libraries\Tools;
use App\Order_Item;

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
    public function get_total_price_formated() {
        return Tools::price_format($this->get_total_price());
    }
    public function cart_to_order($order_id) {
        $order_item = new Order_Item();
        $order_item->product_id = $this->product_id;
        $order_item->detail_id = $this->detail_id;
        $order_item->quantity = $this->amount;
        $order_item->order_id = $order_id;
        $order_item->save();
        
        $this->delete();
    }
}
