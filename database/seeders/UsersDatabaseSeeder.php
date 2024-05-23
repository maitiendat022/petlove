<?php

namespace Database\Seeders;

use App\Http\Controllers\Admin\UsersController;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =
            [
                [
                    'name' => 'Quản lý',
                    'email' => 'admin@gmail.com',
                    'password' => bcrypt('admin123'),
                    'role_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Nhân viên bán hàng',
                    'email' => 'nvbanhang@gmail.com',
                    'password' => bcrypt('123456'),
                    'role_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Nhân viên kho',
                    'email' => 'nvkho@gmail.com',
                    'password' => bcrypt('123456'),
                    'role_id' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Nhân viên chăm sóc',
                    'email' => 'nvchamsoc@gmail.com',
                    'password' => bcrypt('123456'),
                    'role_id' => 5,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];

        foreach($data as $data){
            User::updateOrCreate($data);
        }
    }
}
