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
	    return $this->belongsTo('App\Product', 'product_id');
	}
}
