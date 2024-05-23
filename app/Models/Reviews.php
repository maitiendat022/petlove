<?php

namespace App\Models;

use App\Traits\ReviewUploadImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory, ReviewUploadImageTrait;
    protected $fillable = [
        'user_id',
        'orderProduct_id',
        'product_id',
        'rating',
        'comment',
        'image',
        'feedback',
    ];
    public function orderProduct()
    {
        return $this->belongsTo(OrderProduct::class, 'orderProduct_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
