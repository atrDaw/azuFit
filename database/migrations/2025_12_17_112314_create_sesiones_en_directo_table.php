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
        Schema::create('sesiones_en_directo', function (Blueprint $table) {
            $table->id();
            $table->string('titulo',200);
            $table->foreignId('disciplina_id')->constrained('disciplinas')->onDelete('cascade');
            $table->dateTime('fecha_hora');
            $table->string('url_reunion',255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesiones_en_directo');
    }
};
