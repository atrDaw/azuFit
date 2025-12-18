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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('sesion_id')->constrained('sesiones_en_directo')->onDelete('cascade');
            $table->enum('estado', ['pendiente', 'confirmada', 'cancelada'])->default('pendiente');
            $table->boolean('mail_enviado')->default(false);
            $table->timestamps();

            $table->unique(['user_id', 'sesion_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
