<?php

namespace Database\Factories;

use Database\Seeders\CategorySeeder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    public const CATEGORIES = ['News', 'Life', 'Entertainment', 'Finance', 'Sports'];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $key = array_rand(self::CATEGORIES);

        return [
            'name' => self::CATEGORIES[$key],
            'order' => ++$key
        ];
    }
}
