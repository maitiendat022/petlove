<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryChildrenDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Đồ chơi cho chó', 'pet_id' => 1, 'parent_id' => 1],
            ['name' => 'Dụng cụ ăn uống', 'pet_id' => 1, 'parent_id' => 1],
            ['name' => 'Dụng cụ huấn luyện', 'pet_id' => 1, 'parent_id' => 1],
            ['name' => 'Nhà, nệm, lều, ổ', 'pet_id' => 1, 'parent_id' => 1],
            ['name' => 'Túi, vali, lồng vận chuyển', 'pet_id' => 1, 'parent_id' => 1],

            ['name' => 'Khay vệ sinh', 'pet_id' => 1, 'parent_id' => 2],
            ['name' => 'Kìm cắt móng', 'pet_id' => 1, 'parent_id' => 2],
            ['name' => 'Lược chải lông', 'pet_id' => 1, 'parent_id' => 2],
            ['name' => 'Máy sấy lông', 'pet_id' => 1, 'parent_id' => 2],
            ['name' => 'Tông đơ cắt tỉa lông', 'pet_id' => 1, 'parent_id' => 2],

            ['name' => 'Giày cho chó', 'pet_id' => 1, 'parent_id' => 3],
            ['name' => 'Mũ cho chó', 'pet_id' => 1, 'parent_id' => 3],
            ['name' => 'Quần áo cho chó', 'pet_id' => 1, 'parent_id' => 3],
            ['name' => 'Phụ kiện cho chó', 'pet_id' => 1, 'parent_id' => 3],

            ['name' => 'Mỹ phẩm cho chó', 'pet_id' => 1, 'parent_id' => 4],
            ['name' => 'Nước hoa cho chó', 'pet_id' => 1, 'parent_id' => 4],
            ['name' => 'Sữa tắm khô cho chó', 'pet_id' => 1, 'parent_id' => 4],
            ['name' => 'Sữa tắm trị ve, rận', 'pet_id' => 1, 'parent_id' => 4],
            ['name' => 'Sữa tắm ướt cho chó', 'pet_id' => 1, 'parent_id' => 4],

            ['name' => 'Pate cho chó', 'pet_id' => 1, 'parent_id' => 5],
            ['name' => 'Snack - Xương - Bánh', 'pet_id' => 1, 'parent_id' => 5],
            ['name' => 'Sữa cho chó', 'pet_id' => 1, 'parent_id' => 5],
            ['name' => 'Thức ăn khô cho cho', 'pet_id' => 1, 'parent_id' => 5],
            ['name' => 'Thức ăn ướt cho cho', 'pet_id' => 1, 'parent_id' => 5],

            ['name' => 'Calxi & Vitamin', 'pet_id' => 1, 'parent_id' => 6],
            ['name' => 'Thuốc trị ve, rận, bọ chét', 'pet_id' => 1, 'parent_id' => 6],
            ['name' => 'Vệ sinh răng miệng, tai mắt', 'pet_id' => 1, 'parent_id' => 6],

        ];
        foreach($data as $data){
            Categories::updateOrCreate($data);
        }
    }
}
