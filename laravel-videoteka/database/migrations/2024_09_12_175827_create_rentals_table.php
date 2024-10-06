<?php

use App\Models\Copy;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->timestamp('rental_date');
            $table->timestamp('return_date')->nullable()->default(null);
            $table->foreignIdFor(User::class)->constrained();
            $table->timestamps();
        });

        Schema::create('copy_rental', function (Blueprint $table) {
            $table->foreignIdFor(Rental::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Copy::class)->constrained()->cascadeOnDelete();
            $table->primary(['rental_id', 'copy_id']);
            $table->timestamp('return_date')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
        Schema::dropIfExists('copy_rental');
    }
};
