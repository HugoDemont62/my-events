<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $events = Event::all();

        foreach ($events as $event) {
            // Select a random number of categories to attach to the event
            $categoriesToAttach = $categories->random(rand(1, 3));

            // Attach the categories to the event
            $event->categories()->attach($categoriesToAttach);
        }
    }
}
