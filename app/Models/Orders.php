<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'status',
        'reciver_name',
        'reciver_phone',
        'reciver_address',
        'total',
        'note',
        'payment',
    ];
    public function orderProduct(){
        return $this->hasMany(OrderProduct::class, 'order_id');
    }
}
