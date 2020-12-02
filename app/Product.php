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
    
    public function details()
    {
        return $this->hasMany('App\Product_Detail', 'product_id', 'product_id');
    }
}
