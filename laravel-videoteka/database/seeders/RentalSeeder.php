<?php

namespace Database\Seeders;

use App\Models\Copy;
use App\Models\Rental;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class RentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $copies = Copy::all();

        Rental::factory(20)->sequence(
            ['return_date' => fake()->dateTimeBetween('-1 week', 'now')],
            ['return_date' => null],
        )->create()->each(function(Rental $rental) use ($copies){
            $rental->copies()->attach($copies->random(2)->pluck('id'), [
                'return_date' => $rental->return_date
            ]);
        });
    }
}
