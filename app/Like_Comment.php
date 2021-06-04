<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like_Comment extends Model
{
    
    protected $fillable = [
    	'user_id',
    	'comment_id'
    ];
    protected $table = 'tbl_like_comment';

    public function user(){
        return $this->belongsTo('App\User', 'user_id')->first();
    }
    public function comment(){
        return $this->belongsTo('App\Post_Comment', 'comment_id')->first();
    }
}
