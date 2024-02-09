<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Avis>
 */
class AvisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'event_id' => Event::factory(),
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'grade' => $this->faker->numberBetween(1, 5),
        ];
    }
}
