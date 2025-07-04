<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('programas', function (Blueprint $table) {
            $table->id('id_programa');
            $table->string('nombre_programa', 255);
            $table->boolean('estado');
            $table->foreignId('area_id')->constrained('areas', 'id_area');
            $table->timestamp('fecha_creacion');
            $table->timestamp('fecha_modificacion');
        });
    }

    public function down()
    {
        Schema::dropIfExists('programas');
    }
};
