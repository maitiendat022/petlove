<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'detail_id',
        'quantity',
        'total',
    ];
    public function order(){
        return $this->belongsTo(Orders::class, 'order_id');
    }
    public function detail(){
        return $this->belongsTo(ProductDetail::class);
    }
    public function product(){
        return $this->belongsTo(Products::class);
    }
}
