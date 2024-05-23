<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pets extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
    ];
    public function categories(){
        return $this->hasMany(Categories::class, 'pet_id');
    }
    public function updateInactive(){
        if ($this->categories()->where('status', 'active')->doesntExist()) {
            $this->update(['status' => 'inactive']);
            return ['type' => 'success', 'message' => 'Xóa thú cưng thành công'];
        }else{
            return ['type' => 'danger', 'message' => 'Vẫn còn danh mục thuộc loại thú cưng này đang được bán'];
        }
    }
    public function updateActive(){
        $this->update(['status' => 'active']);
        return ['type' => 'success', 'message' => 'Mở lại thú cưng thành công'];
    }
}
