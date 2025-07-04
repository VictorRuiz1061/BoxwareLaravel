<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sedes', function (Blueprint $table) {
            $table->id('id_sede');
            $table->string('nombre_sede', 255);
            $table->string('direccion_sede', 255);
            $table->boolean('estado');
            $table->foreignId('centro_id')->constrained('centros', 'id_centro');
            $table->timestamp('fecha_creacion');
            $table->timestamp('fecha_modificacion');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sedes');
    }
};
