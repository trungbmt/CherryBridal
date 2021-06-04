<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_Comment extends Model
{
    protected $fillable = [
    	'content',
    	'reply_id',
    	'post_id',
    	'user_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_post_comment';
    public function user(){
        return $this->belongsTo('App\User', 'user_id')->first();
    }
    public function post(){
        return $this->belongsTo('App\Post', 'post_id')->first();
    }
    public function replies() {
        return $this->hasMany('App\Post_Comment', 'reply_id', 'id');
    }
    public function likes() {
        return $this->hasMany('App\Like_Comment', 'comment_id');
    }
}
