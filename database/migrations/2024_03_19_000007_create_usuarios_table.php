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
            $table->string('nombre_usuario', 255);
            $table->string('apellido_usuario', 255);
            $table->integer('edad')->nullable();
            $table->string('cedula', 20)->nullable()->unique();
            $table->string('email', 255)->unique();
            $table->string('password');
            $table->string('telefono', 20)->nullable();
            $table->string('imagen', 255)->nullable();
            $table->boolean('estado')->default(true);
            $table->timestamp('fecha_registro')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->foreignId('rol_id')->constrained('roles', 'id_rol');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
