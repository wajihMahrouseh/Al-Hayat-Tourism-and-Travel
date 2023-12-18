<?php

use App\Models\Site;
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
        Schema::create('journeys', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->string('duration');
            $table->integer('price');
            $table->text('description');
            $table->integer('rows');
            $table->integer('right_columns');
            $table->integer('left_columns');
            $table->integer('back_columns');
            $table->foreignIdFor(Site::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journeys');
    }
};
