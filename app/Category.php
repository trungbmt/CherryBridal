<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
    	'category_name',
    	'category_desc',
    	'category_img',
    	'category_status'
    ];
    protected $primaryKey = 'category_id';
    protected $table = 'tbl_category';

    public function products()
    {
        return $this->hasMany('App\Product', 'product_category', 'category_id');
    }
    public function get_newest_products($number)
    {
        return $this->hasMany('App\Product', 'product_category', 'category_id')->orderBy('created_at','desc')->limit($number)->get();
    }
}
