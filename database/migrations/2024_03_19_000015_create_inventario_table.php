<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('inventario', function (Blueprint $table) {
            $table->id('id_inventario');
            $table->integer('stock');
            $table->string('placa_sena');
            $table->string('descripcion');
            $table->foreignId('sitio_id')->constrained('sitios', 'id_sitio');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventario');
    }
};
