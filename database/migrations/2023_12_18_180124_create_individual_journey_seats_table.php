<?php

use App\Models\ReservationOrder;
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
        Schema::create('individual_journey_seats', function (Blueprint $table) {
            $table->id();
            $table->integer('seat_number');
            $table->foreignIdFor(ReservationOrder::class);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('place_and_birth_date');
            $table->string('national_number');
            $table->string('phone');
            $table->string('email');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('individual_journey_seats');
    }
};
