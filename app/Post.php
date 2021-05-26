<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
    	'user_id',
    	'media',
    	'description'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_post';
    public function user(){
        return $this->belongsTo('App\User', 'user_id')->first();
    }
    public function poster(){
        return $this->belongsTo('App\User', 'user_id');
    }
    public function likes(){
        return $this->hasMany('App\Like', 'post_id')->count();
    }
}
