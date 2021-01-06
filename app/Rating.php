<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
    	'content',
    	'value',
    	'product_id',
    	'user_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_rating';


    public function user(){
        return $this->belongsTo('App\User', 'user_id')->first();
    }
    public function product(){
        return $this->belongsTo('App\Product', 'product_id')->first();
    }
}
