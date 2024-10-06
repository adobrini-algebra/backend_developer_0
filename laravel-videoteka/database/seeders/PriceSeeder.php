<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    private const TYPES = ['Hit', 'Ne-hit', 'Stari'];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::TYPES as $type) {
            Price::factory()->create([
                'type' => $type
            ]);
        }
    }
}
