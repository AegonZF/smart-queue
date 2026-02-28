<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_counters', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'ventanilla' o 'asesor'
            $table->string('identifier'); // 'A', 'B', 'C' o '1', '2', '3', '4'
            $table->string('label'); // 'Ventanilla A', 'Asesor 1', etc.
            $table->unsignedInteger('current_turn')->default(0); // Último turno generado (0-999)
            $table->unsignedInteger('active_clients')->default(0); // Clientes en espera
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_counters');
    }
};
