<?php

namespace Database\Seeders;

use App\Models\Pets;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Chó'],
            ['name' => 'Mèo'],
        ];
        foreach($data as $data){
            Pets::updateOrCreate($data);
        }
    }
}
