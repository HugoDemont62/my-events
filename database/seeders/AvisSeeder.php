<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Avis;
use App\Models\Event;

class AvisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::all();

        foreach ($events as $event) {
            Avis::factory(rand(1, 5))->create(['event_id' => $event->id]);
        }
    }
}
