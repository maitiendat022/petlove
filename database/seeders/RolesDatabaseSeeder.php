<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ['name' => 'Quản lý'],
            ['name' => 'Khách hàng'],
            ['name' => 'Nhân viên bán hàng'],
            ['name' => 'Nhân viên kho'],
            ['name' => 'Nhân viên chăm sóc'],

        ];
        foreach($data as $data){
            Roles::updateOrCreate($data);
        }
    }
}
