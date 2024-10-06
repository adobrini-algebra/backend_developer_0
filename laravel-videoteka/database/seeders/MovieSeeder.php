<?php

namespace Database\Seeders;

use App\Models\Copy;
use App\Models\Format;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Price;
use App\Services\BarcodeService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barcdeService = new BarcodeService();
        $allGenres = Genre::all();
        $allPrices = Price::all();
        $allFormats = Format::all();

        foreach ($allGenres as $genre) {

            foreach ($allPrices as $price) {

                Movie::factory(3)->create([
                    'genre_id' => $genre->id,
                    'price_id' => $price->id
                ])->each(function(Movie $movie) use ($allFormats, $barcdeService){

                    foreach ($allFormats as $format) {
                        $movie->copies()->save(Copy::factory()->create([
                            'format_id' => $format,
                            'barcode' => $barcdeService->generate($movie, $format->type)
                        ]));
                    }
                });
            }
        }
    }
}
