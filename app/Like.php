<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
    	'user_id',
    	'post_id'
    ];
    protected $table = 'tbl_like';
    public function user(){
        return $this->belongsTo('App\User', 'user_id')->first();
    }
    public function post(){
        return $this->belongsTo('App\Post', 'post_id')->first();
    }
}
