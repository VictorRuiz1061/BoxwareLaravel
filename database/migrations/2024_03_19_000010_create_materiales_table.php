<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('materiales', function (Blueprint $table) {
            $table->id('id_material');
            $table->string('codigo_sena', 100);
            $table->string('nombre_material', 255);
            $table->text('descripcion_material');
            $table->string('unidad_medida', 100);
            $table->boolean('producto_peresedero');
            $table->boolean('estado');
            $table->date('fecha_vencimiento');
            $table->string('imagen');
            $table->foreignId('categoria_id')->constrained('categorias_elementos', 'id_categoria_elemento');
            $table->foreignId('tipo_material_id')->constrained('tipo_materiales', 'id_tipo_material');
            $table->timestamp('fecha_creacion');
            $table->timestamp('fecha_modificacion');
        });
    }

    public function down()
    {
        Schema::dropIfExists('materiales');
    }
};
