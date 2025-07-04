<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tipo_materiales', function (Blueprint $table) {
            $table->id('id_tipo_material');
            $table->string('tipo_elemento', 100);
            $table->boolean('estado');
            $table->timestamp('fecha_creacion');
            $table->timestamp('fecha_modificacion');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_materiales');
    }
};
