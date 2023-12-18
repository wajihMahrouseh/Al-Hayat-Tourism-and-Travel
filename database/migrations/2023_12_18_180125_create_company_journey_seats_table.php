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
        Schema::create('company_journey_seats', function (Blueprint $table) {
            $table->id();
            $table->integer('seat_number');
            $table->foreignIdFor(ReservationOrder::class);
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_journey_seats');
    }
};
