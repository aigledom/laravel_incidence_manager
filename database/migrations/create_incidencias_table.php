<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('dni')->nullable();
            $table->string('telefono');
            $table->string('email');
            $table->string('adjuntar_imagen')->nullable();
            $table->text('descripcion');
            $table->unsignedBigInteger('id_cat');
            $table->string('estado');
            $table->string('ubicacion')->nullable();
            $table->timestamp('fecha_creacion');
            $table->timestamp('fecha_resolucion')->nullable();
            $table->foreign('id_cat')->references('id')->on('categorias');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('incidencias');
    }
};
