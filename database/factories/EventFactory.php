<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
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
            'images/' . $faker->image('public/storage/images', 640, 480, null, false),
            'admin_id' => $faker->numberBetween(1, 10),
        ];
    }
}
