<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('clases', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 200);
            $table->text('descripcion');
            $table->foreignId('disciplina_id')->constrained('disciplinas')->onDelete('cascade');
            $table->enum('nivel', ['Principiante', 'Intermedio', 'Avanzado']);
            $table->string('url_video', 255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('clases');
    }
};
