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
        Schema::create('actividades', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('id_usuario');
            $table->string('nombre_actividad',40);
            $table->string('descripcion',100);
            $table->integer('id_categoria');
            $table->datetime('fecha_hora_inicio');
            $table->datetime('fecha_hora_termino');
            $table->datetime('recordatorio')->nullable();
            $table->foreign('id_usuario')->references('id')->on('usuarios');
            $table->foreign('id_categoria')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actividades');
    }
};
