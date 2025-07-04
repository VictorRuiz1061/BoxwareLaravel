<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sitios', function (Blueprint $table) {
            $table->id('id_sitio');
            $table->string('nombre_sitio', 255);
            $table->string('ubicacion', 255);
            $table->string('ficha_tecnica', 255);
            $table->boolean('estado');
            $table->foreignId('tipo_sitio_id')->constrained('tipos_sitio', 'id_tipo_sitio');
            $table->timestamp('fecha_creacion');
            $table->timestamp('fecha_modificacion');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sitios');
    }
};
