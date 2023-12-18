<?php

use App\Models\ReservationOrder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('delivery_orders', function (Blueprint $table) {
            $table->id();
            $table->string('governorate');
            $table->string('region');
            $table->string('street');
            $table->string('building_number');
            $table->string('details');
            $table->string('latitude');
            $table->string('longitude');
            $table->foreignIdFor(ReservationOrder::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_orders');
    }
};
