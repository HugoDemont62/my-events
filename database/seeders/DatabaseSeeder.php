<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            EventSeeder::class,
            EventCategorySeeder::class,
            UserSeeder::class,
            AvisSeeder::class,
            EventUserSeeder::class,
        ]);
    }
}
