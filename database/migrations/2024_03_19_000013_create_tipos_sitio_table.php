<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tipos_sitio', function (Blueprint $table) {
            $table->id('id_tipo_sitio');
            $table->string('nombre_tipo_sitio', 255);
            $table->boolean('estado');
            $table->timestamp('fecha_creacion');
            $table->timestamp('fecha_modificacion');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_sitio');
    }
};
