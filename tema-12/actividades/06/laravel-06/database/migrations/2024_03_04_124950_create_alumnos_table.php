<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('name', 35);
            $table->string('apellidos', 45);
            $table->date('fecha_nacimiento');
            $table->char('telefono', 13)->nullable(false);
            $table->string('poblacion', 20);
            $table->char('dni', 9)->unique()->nullable(false);
            $table->string('email', 40)->unique();
            $table->unsignedBigInteger('curso_id');
            // Restricciones
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
