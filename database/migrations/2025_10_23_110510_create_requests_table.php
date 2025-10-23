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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            // Keep requests for history even if client is deleted
            $table->foreignId('client_id')->nullable()->constrained()->nullOnDelete();
            $table->date('event_date')->nullable(); // Giorno dell’evento scelto dal cliente
            $table->string('status')->default('pending'); // pending, awaiting_payment, paid
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
