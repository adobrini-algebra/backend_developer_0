<?php

namespace Database\Factories;

use App\Models\Format;
use App\Models\Movie;
use App\Services\BarcodeService;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Copy>
 */
class CopyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $movie = Movie::inRandomOrder()->first();
        $format = Format::inRandomOrder()->first();

        $barcdeService = new BarcodeService();
        $barcode = $barcdeService->generate($movie, $format->type);

        return [
            'barcode' => $barcode,
            'movie_id' => $movie->id,
            'format_id' => $format->id,
        ];
    }
}
