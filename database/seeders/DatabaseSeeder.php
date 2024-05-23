<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesDatabaseSeeder::class,
            UsersDatabaseSeeder::class,
            PetsDatabaseSeeder::class,
            CategoriesDatabaseSeeder::class,
            CategoryChildrenDatabaseSeeder::class,
            ServieceDatabaseSeeder::class,
        ]);
    }
}
