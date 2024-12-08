<?php

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
        Schema::create('travel_data', function (Blueprint $table) {
            $table->id();
            $table->string('from');
            $table->string('to');
            $table->enum('type', ['bus', 'train', 'flight']);
            $table->string('route');  // Added 'route' column
            $table->string('best_way');  // Added 'best_way' column
            $table->string('available_time');  // Added 'available_time' column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_data');
    }
};
