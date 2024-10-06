<?php

namespace Database\Factories;

use App\Models\Rental;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rental>
 */
class RentalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'rental_date' => fake()->dateTimeBetween('-1 month', '-2 week'),
            'return_date' => fake()->dateTimeBetween('-1 week', 'now'),
            'user_id' => User::factory(),
        ];
    }
}
