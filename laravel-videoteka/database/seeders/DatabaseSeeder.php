<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\User;
use App\Models\Price;
use App\Models\Rental;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            GenreSeeder::class,
            PriceSeeder::class,
            FormatSeeder::class,
            MovieSeeder::class,
            RentalSeeder::class,
        ]);




        // Price::factory(3)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
