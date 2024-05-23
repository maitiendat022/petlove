<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'serviece_id',
        'status',
        'time',
        'date',
        'book_name',
        'book_phone',
        'pet_name',
        'pet_age',
        'pet_specie',
        'pet_weight',
        'note'
    ];
    public function serviece(){
        return $this->belongsTo(Servieces::class, 'serviece_id');
    }
    public function getServieceNameAttribute(){
        return optional($this->serviece)->name;
    }
}
