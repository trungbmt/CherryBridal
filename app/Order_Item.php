<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Item extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'product_id',
    	'detail_id',
    	'quantity',
    	'order_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_order_item';

    public function order(){
	    return $this->belongsTo('App\Order', 'order_id');
	}
    public function product(){
	    return $this->belongsTo('App\Product', 'product_id')->first();
	}
    public function get_product_detail() {
        return $this->belongsTo('App\Product_Detail', 'detail_id')->first();
    }
    public function get_total_price() {
        $price = $this->get_product_detail()->product_price;
        return $price*$this->quantity;
    }
    public function product_api() {
        return $this->belongsTo('App\Product', 'product_id');
    }
    public function detail_api() {
        return $this->belongsTo('App\Product_Detail', 'detail_id');
    }
}
