<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Cart;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Libraries\Tools;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 
        'email', 
        'password',
        'role',
        'avatar',
        'provider',
        'provider_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }
    public function getJWTCustomClaims() {
        return [];
    }

    public function hasRole($role) {
        if($this->role==$role) return true;
        return false;
    }
    public function carts()
    {
        return $this->hasMany('App\Cart', 'user_id', 'id');
    }
    public function orders()
    {
        return $this->hasMany('App\Order', 'user_id', 'id');
    }
    public function rates()
    {
        return $this->hasMany('App\Rating', 'user_id', 'id');
    }
    public function likedPost($post_id) {
        $liked = $this->hasMany('App\Like', 'user_id', 'id')->where('post_id', $post_id)->first();
        if($liked) return true;
        return false;
    }
    public function likedPostComment($comment_id) {
        $liked = $this->hasMany('App\Like_Comment', 'user_id')->where('comment_id', $comment_id)->first();
        if($liked) return true;
        return false;
    }
    public function total_cart_money() {
        $cart_list = $this->carts()->get();
        $total = 0;
        foreach ($cart_list as $cart) {
            $total+= $cart->get_total_price();
        }
        return $total;
    }
    public function total_cart_money_formated() {
        return Tools::price_format($this->total_cart_money());
    }
    public function scopeSearch($query, $request) {
        if($request->search) 
            {
                $search = $request->search;
                $query->where('username', 'like', '%'.$search.'%')->orWhere('email', 'like', '%'.$search.'%')->orWhere('id', 'like', '%'.$search.'%');
            }
        return $query;
    }
    public function isBought($product_id) {
        $result = $this->orders()->join('tbl_order_item', 'tbl_order.order_id','=','tbl_order_item.order_id')->where('product_id', $product_id)->count();
        if($result>0) return true;
        return false;
    }
    public function get_rating($product_id) {
        return $this->rates()->where('product_id', $product_id);
    }
}
