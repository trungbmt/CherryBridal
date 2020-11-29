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
}
