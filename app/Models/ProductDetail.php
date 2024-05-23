<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $table = "product_detail";
    protected $fillable = [
        'product_id',
        'size',
        'color',
        'price',
        'quantity',
    ];
    public function product()
    {
        return $this->belongsTo(Products::class, 'id');
    }
}
