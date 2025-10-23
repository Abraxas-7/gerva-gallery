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
        Schema::create('track_spots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->nullable()->constrained('locations')->nullOnDelete();
            $table->string('name'); // Es. "Curva 1", "Partenze", "Salita 3"
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('track_spots');
    }
};
