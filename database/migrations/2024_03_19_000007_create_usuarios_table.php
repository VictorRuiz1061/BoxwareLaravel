<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nombre', 255);
            $table->string('apellido', 255);
            $table->integer('edad');
            $table->string('cedula', 20)->unique();
            $table->string('email', 255)->unique();
            $table->string('password');
            $table->string('telefono', 20);
            $table->string('imagen', 255);
            $table->boolean('estado');
            $table->timestamp('fecha_registro');
            $table->foreignId('rol_id')->constrained('roles', 'id_rol');
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
