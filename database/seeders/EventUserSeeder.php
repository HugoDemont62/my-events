<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::all();
        $users = User::all();

        if ($users->isEmpty()) {
            echo 'No users found. Please ensure users are seeded before running this seeder.';
            return;
        }

        foreach ($events as $event) {
            $usersToAttach = $users->random(rand(1, 5));

            $event->users()->attach($usersToAttach);
        }
    }
}
