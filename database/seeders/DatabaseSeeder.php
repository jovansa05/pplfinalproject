<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            KecamatanSeeder::class,
            KelurahanSeeder::class,
            CategorySeeder::class,
            AdminUserSeeder::class,  
            // DummyUserSeeder::class, // Uncomment jika ingin dummy users
        ]);
    }
}