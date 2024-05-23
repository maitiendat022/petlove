<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'detail_id',
        'product_id',
        'quantity',
    ];
    public function cart(){
        return $this->belongsTo(Carts::class, 'id');
    }
    public function detail(){
        return $this->belongsTo(ProductDetail::class,'detail_id');
    }
    public function product(){
        return $this->belongsTo(Products::class);
    }
    public function get($cart_id, $detail_id){
        return CartProduct::whereCartId($cart_id)->whereDetailId($detail_id)->first();
    }
    public function getTotalAttribute(){
        return $this->quantity * $this->detail->price;
    }
}
