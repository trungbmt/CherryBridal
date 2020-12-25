<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Libraries\Tools;

class Order extends Model
{
    protected $fillable = [
    	'user_id',
    	'order_full_name',
    	'order_phone',
    	'order_status',
    	'order_city',
    	'order_province',
    	'order_address'
    ];
    protected $primaryKey = 'order_id';
    protected $table = 'tbl_order';


    public function user(){
        return $this->belongsTo('App\User', 'user_id')->first();
    }
    public function items() {
        return $this->hasMany('App\Order_Item', 'order_id', 'order_id');
    }
    public function price(){
    	$price = 0;
    	$all_item = $this->items()->get();
    	foreach ($all_item as $item) {
    		$price+= $item->get_total_price();
    	}
    	return $price;
    }
    public function price_formated(){
    	return Tools::price_format($this->price());
    }
}
