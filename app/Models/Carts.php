<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];
    public function cartProduct(){
        return $this->hasMany(CartProduct::class, 'cart_id');
    }
    public function get($user_id){
        return Carts::whereUserId($user_id)->first();
    }
    public function firstOrCreate($user_id){
        $cart = $this->get($user_id);
        if(!$cart){
            $cart = $this->create(['user_id'=>$user_id]);
        }
        return $cart;
    }
    public function getTotalCartAttribute(){
        return $this->cartProduct->sum(function ($cartProduct) {
            return $cartProduct->total;
        });
    }
}
