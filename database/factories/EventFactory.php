<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('fr_FR');

        $startDate = $faker->dateTimeBetween('now', '+2 years');
        $endDate = $faker->dateTimeBetween($startDate, '+3 years');

        // Liste d'adresses prédéfinies
        $predefinedAddresses = [
            '123 Rue de Paris, 75000 Paris',
            '456 Boulevard Saint-Germain, 75000 Paris',
            '789 Avenue des Champs-Élysées, 75000 Paris',
        ];

        $location = $faker->randomElement($predefinedAddresses);

        return [
            'title' => $faker->sentence,
            'description' => $faker->paragraph,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'location' => $location,
            'capacity' => $faker->numberBetween(50, 200),
            'price' => $faker->numberBetween(0, 1000),
            'admin_id' => $faker->numberBetween(1, 10),
        ];
    }
}
