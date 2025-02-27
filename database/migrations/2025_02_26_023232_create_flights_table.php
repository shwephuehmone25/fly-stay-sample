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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('flight_number')->unique();
            $table->string('airline');
            $table->string('departure_airport');
            $table->string('arrival_airport');
            $table->dateTime('departure_time')->index();
            $table->dateTime('arrival_time')->index();
            $table->integer('total_seats');
            $table->integer('available_seats')->index();
            $table->decimal('price', 10, 2);
            $table->enum('status', ['scheduled', 'delayed', 'cancelled'])->default('scheduled');
            $table->enum('flight_type', ['oneway', 'rounded'])->default('oneway');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
