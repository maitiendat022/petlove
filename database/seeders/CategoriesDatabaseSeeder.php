<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Đồ dùng cho chó', 'pet_id' => 1],
            ['name' => 'Dụng cụ vệ sinh cho chó', 'pet_id' => 1],
            ['name' => 'Quần áo, phụ kiện cho chó', 'pet_id' => 1],
            ['name' => 'Sữa tắm cho chó', 'pet_id' => 1],
            ['name' => 'Thức ăn cho chó', 'pet_id' => 1],
            ['name' => 'Y tế và thuốc cho chó', 'pet_id' => 1],
            
            ['name' => 'Đồ dùng cho mèo', 'pet_id' => 2,],
            ['name' => 'Dụng cụ vệ sinh cho mèo', 'pet_id' => 2],
            ['name' => 'Quần áo, phụ kiện cho mèo', 'pet_id' => 2],
            ['name' => 'Sữa tắm cho mèo', 'pet_id' => 2],
            ['name' => 'Thức ăn cho mèo', 'pet_id' => 2],
            ['name' => 'Y tế và thuốc cho mèo', 'pet_id' => 2],

        ];
        foreach($data as $data){
            Categories::updateOrCreate($data);
        }

    }
}
