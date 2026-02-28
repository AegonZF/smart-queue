<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('turns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_counter_id')->constrained()->onDelete('cascade');
            $table->string('turn_number'); // Ej: "A-001", "Asesor1-015"
            $table->string('service_type'); // 'ventanilla' o 'asesor'
            $table->string('tramite')->nullable(); // 'pago_deposito', 'problema_banca', etc.
            $table->enum('status', ['waiting', 'in_progress', 'completed', 'expired', 'cancelled'])->default('waiting');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('turns');
    }
};
