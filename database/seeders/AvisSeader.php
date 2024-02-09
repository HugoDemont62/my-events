<?php

namespace Database\Seeders;

use App\Models\Avis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvisSeader extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Avis::factory(10)->create();
    }
}
