<?php

use App\Models\Journey;
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
        Schema::create('reservation_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('total_journey_seat_num');
            $table->integer('status')->default(1);
            $table->foreignIdFor(Journey::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_orders');
    }
};
