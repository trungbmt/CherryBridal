<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
    	'content',
    	'reply_id',
    	'product_id',
    	'user_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_comment';


    public function user(){
        return $this->belongsTo('App\User', 'user_id')->first();
    }
    public function replies() {
        return $this->hasMany('App\Comment', 'reply_id', 'id');
    }
}
