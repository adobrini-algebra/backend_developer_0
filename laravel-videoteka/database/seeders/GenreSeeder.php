<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    private const GENRES = ['Action', 'Adventure', 'Animated', 'Comedy', 'Documentary', 'Drama', 'Fantasy', 'Historcal', 'Horror', 'Musical', 'Noir', 'Romance', 'Science Fiction', 'Thriller', 'Western'];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::GENRES as $genre) {
            Genre::factory()->create([
                'name' => $genre
            ]);
        }
    }
}
