<?php

namespace Database\Factories;

use App\Models\Genre;
use App\Models\Price;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => ucfirst(strtolower(implode(' ', fake()->words(fake()->numberBetween(1, 3))))),
            'year' => fake()->numberBetween(1930, 2024),
            'genre_id' => Genre::factory(),
            'price_id' => Price::factory(),
        ];
    }
}