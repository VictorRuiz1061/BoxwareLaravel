<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Usuario;
use App\Models\Rol;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder principal de la base de datos
 * 
 * Este seeder ejecuta todos los seeders necesarios para configurar
 * la base de datos con datos iniciales del sistema.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecutar seeders en orden
        $this->call([
            RolSeeder::class,
        ]);

        // Crear usuario administrador por defecto
        $adminRol = Rol::where('id_rol', 1)->first();
        
        if ($adminRol) {
            Usuario::updateOrCreate(
                ['email' => 'admin@sena.edu.co'],
                [
                    'nombre_usuario' => 'Administrador',
                    'apellido_usuario' => 'Sistema',
                    'email' => 'admin@sena.edu.co',
                    'password' => Hash::make('admin123'),
                    'estado' => true,
                    'rol_id' => $adminRol->id_rol,
                    'fecha_registro' => now(),
                ]
            );
        }

        // Crear usuario de prueba
        $userRol = Rol::where('id_rol', 3)->first();
        
        if ($userRol) {
            Usuario::updateOrCreate(
                ['email' => 'usuario@sena.edu.co'],
                [
                    'nombre_usuario' => 'Usuario',
                    'apellido_usuario' => 'Prueba',
                    'email' => 'usuario@sena.edu.co',
                    'password' => Hash::make('usuario123'),
                    'estado' => true,
                    'rol_id' => $userRol->id_rol,
                    'fecha_registro' => now(),
                ]
            );
        }

        $this->command->info('Base de datos sembrada exitosamente.');
        $this->command->info('Usuario administrador: admin@sena.edu.co / admin123');
        $this->command->info('Usuario de prueba: usuario@sena.edu.co / usuario123');
    }
}
