<?php

namespace Database\Seeders;

use App\Models\Servieces;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServieceDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ['name' => 'Vệ sinh thú cưng'],
            ['name' => 'Cắt tỉa thú cưng'],
            ['name' => 'Đặt phòng khách sạn'],
            ['name' => 'Khám chữa bệnh'],

        ];

        foreach($data as $data){
            Servieces::updateOrCreate($data);
        }
    }
}
