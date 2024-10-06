<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Format;

class FormatSeeder extends Seeder
{
    private const FORMATS = ['VHS', 'CD', 'DVD', 'Blu-ray'];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::FORMATS as $format) {
            Format::factory()->create([
                'type' => $format
            ]);
        }
    }
}
