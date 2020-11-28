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
}
