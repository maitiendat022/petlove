<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'parent_id',
        'pet_id',
    ];

    public function parent(){
        return $this->belongsTo(Categories::class, 'parent_id');
    }
    public function children(){
        return $this->hasMany(Categories::class, 'parent_id');
    }
    public function pet(){
        return $this->belongsTo(Pets::class, 'pet_id');
    }
    public function products(){
        return $this->hasMany(Products::class, 'category_id');
    }
    public function getParentNameAttribute(){
        return optional($this->parent)->name;
    }
    public function getPetNameAttribute(){
        return optional($this->pet)->name;
    }
    public function updateInactive()
    {
        if ($this->children()->exists()) {
            if ($this->children()->where('status', 'active')->exists()) {
                return ['type' => 'danger', 'message' => 'Vẫn còn danh mục con thuộc danh mục này đang được bán'];
            }else{
                $this->update(['status' => 'inactive']);
                return ['type' => 'success', 'message' => 'Xóa danh mục thành công'];
            }
        }else{
            if ($this->products()->where('status', 'active')->exists()) {
                return ['type' => 'danger', 'message' => 'Vẫn còn sản phẩm thuộc danh mục này đang được bán'];
            }else{
                $this->update(['status' => 'inactive']);
                return ['type' => 'success', 'message' => 'Xóa danh mục thành công'];
            }
        }
    }
    public function updateActive(){
        if($this->children()->exists()) {
            if($this->pet->status === 'active'){
                $this->update(['status' => 'active']);
                return ['type' => 'success', 'message' => 'Mở lại danh mục thành công'];
            }else{
                return ['type' => 'danger', 'message' => 'Loại thú cưng của danh mục này đã bị khóa'];
            }
        }else{
            if($this->parent->status === 'active'){
                $this->update(['status' => 'active']);
                return ['type' => 'success', 'message' => 'Mở lại danh mục thành công'];
            }else{
                return ['type' => 'danger', 'message' => 'Danh mục cha của danh mục này đã bị khóa'];
            }
        }
    }
}
