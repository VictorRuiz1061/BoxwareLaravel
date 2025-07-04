<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('modulos', function (Blueprint $table) {
            $table->id('id_modulo');
            $table->string('rutas', 255);
            $table->string('descripcion_ruta', 255);
            $table->string('mensaje_cambio', 255);
            $table->string('imagen', 255);
            $table->boolean('estado');
            $table->boolean('es_submenu');
            $table->unsignedBigInteger('modulo_padre_id')->nullable();
            $table->foreign('modulo_padre_id')->references('id_modulo')->on('modulos')->nullOnDelete();
            $table->timestamp('fecha_creacion')->nullable();
            $table->timestamp('fecha_accion')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('modulos');
    }
};
