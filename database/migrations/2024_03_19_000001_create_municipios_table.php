<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
            $table->id('id_municipio');
            $table->string('nombre_municipio', 255);
            $table->boolean('estado');
            $table->timestamp('fecha_creacion');
            $table->timestamp('fecha_modificacion');
        });
    }

    public function down()
    {
        Schema::dropIfExists('municipios');
    }
};
