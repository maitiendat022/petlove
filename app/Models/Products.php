<?php

namespace App\Models;

use App\Traits\ProductUploadImageTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory, ProductUploadImageTrait;

    protected $fillable = [
        'name',
        'description',
        'status',
        'category_id',
    ];
    public function images()
    {
        return $this->morphMany(Images::class, 'imageable');
    }
    public function detail()
    {
        return $this->hasMany(ProductDetail::class, 'product_id');
    }
    public function category(){
        return $this->belongsTo(Categories::class, 'category_id');
    }
    public function review()
    {
        return $this->hasMany(Reviews::class, 'product_id');
    }
    public function getCategoryNameAttribute(){
        return optional($this->category)->name;
    }
    public function getImagePathAttribute(){
        return asset('upload/product/'.$this->images->first()->url);
    }
    public function getQuantityDetailAttribute(){
        return $this->detail->first()->quantity;
    }
    public function updateInactive(){
        $this->update(['status' => 'inactive']);
        return ['type' => 'success', 'message' => 'Xóa sản phẩm thành công'];
    }
    public function updateActive(){
        if($this->category->status === 'active'){
            $this->update(['status' => 'active']);
            return ['type' => 'success', 'message' => 'Mở bán lại sản phẩm thành công'];
        }else{
            return ['type' => 'danger', 'message' => 'Danh mục của sản phẩm này đã ngừng bán'];
        }
    }
}
