<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Cart;
use App\Libraries\Tools;

class User extends Authenticatable
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
}
