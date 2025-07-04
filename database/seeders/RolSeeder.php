<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;

/**
 * Seeder para crear los roles del sistema
 * 
 * Este seeder crea los roles básicos necesarios para el funcionamiento
 * del sistema de bodega del SENA.
 */
class RolSeeder extends Seeder
{
    /**
     * Ejecutar el seeder
     * 
     * @return void
     */
    public function run()
    {
        // Crear roles básicos del sistema
        $roles = [
            [
                'id_rol' => 1,
                'nombre_rol' => 'Administrador',
                'descripcion' => 'Rol con acceso completo al sistema',
                'estado' => true,
                'fecha_creacion' => now(),
                'fecha_modificacion' => now()
            ],
            [
                'id_rol' => 2,
                'nombre_rol' => 'Coordinador',
                'descripcion' => 'Rol con acceso a gestión de inventario y reportes',
                'estado' => true,
                'fecha_creacion' => now(),
                'fecha_modificacion' => now()
            ],
            [
                'id_rol' => 3,
                'nombre_rol' => 'Usuario',
                'descripcion' => 'Rol básico para usuarios registrados',
                'estado' => true,
                'fecha_creacion' => now(),
                'fecha_modificacion' => now()
            ],
            [
                'id_rol' => 4,
                'nombre_rol' => 'Instructor',
                'descripcion' => 'Rol para instructores del SENA',
                'estado' => true,
                'fecha_creacion' => now(),
                'fecha_modificacion' => now()
            ],
            [
                'id_rol' => 5,
                'nombre_rol' => 'Aprendiz',
                'descripcion' => 'Rol para aprendices del SENA',
                'estado' => true,
                'fecha_creacion' => now(),
                'fecha_modificacion' => now()
            ]
        ];

        foreach ($roles as $rol) {
            Rol::updateOrCreate(
                ['id_rol' => $rol['id_rol']],
                $rol
            );
        }

        $this->command->info('Roles creados exitosamente.');
    }
} 