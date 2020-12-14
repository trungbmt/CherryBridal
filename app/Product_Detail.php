<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Detail extends Model
{
	public $timestamps = false;
    protected $fillable = [
    	'product_id',
    	'product_size',
    	'product_amount',
    	'product_price'
    ];
    protected $primaryKey = 'detail_id';
    protected $table = 'tbl_product_detail';

    public function product(){
	    return $this->belongsTo('App\Product', 'product_id');
	}
    public function get_price_formated() {
        return number_format($this->product_price, 0, ',', '.').'đ';
    }
}
