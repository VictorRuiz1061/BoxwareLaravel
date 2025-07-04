<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/**
 * Rutas de Consola del Sistema de Bodega SENA
 * 
 * Este archivo contiene los comandos Artisan personalizados para el sistema.
 * Los comandos facilitan tareas administrativas y de mantenimiento.
 */

/**
 * Comando para mostrar una frase inspiradora
 * Útil para verificar que la consola funciona correctamente
 */
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/**
 * Comando para limpiar y optimizar el sistema
 * Ejecuta múltiples comandos de mantenimiento
 */
Artisan::command('sistema:limpiar', function () {
    $this->info('🧹 Limpiando el sistema...');
    
    // Limpiar caché
    $this->call('cache:clear');
    $this->info('✅ Caché limpiada');
    
    // Limpiar configuración
    $this->call('config:clear');
    $this->info('✅ Configuración limpiada');
    
    // Limpiar rutas
    $this->call('route:clear');
    $this->info('✅ Rutas limpiadas');
    
    // Limpiar vistas
    $this->call('view:clear');
    $this->info('✅ Vistas limpiadas');
    
    // Optimizar autoloader
    $this->call('optimize:clear');
    $this->info('✅ Optimización limpiada');
    
    $this->info('🎉 Sistema limpiado exitosamente');
})->purpose('Limpiar y optimizar el sistema de bodega');

/**
 * Comando para verificar el estado del sistema
 * Revisa la conectividad de base de datos y configuraciones
 */
Artisan::command('sistema:estado', function () {
    $this->info('🔍 Verificando estado del sistema...');
    
    // Verificar conexión a base de datos
    try {
        \DB::connection()->getPdo();
        $this->info('✅ Conexión a base de datos: OK');
    } catch (\Exception $e) {
        $this->error('❌ Error de conexión a base de datos: ' . $e->getMessage());
    }
    
    // Verificar migraciones
    $pendingMigrations = \Artisan::call('migrate:status');
    $this->info('📊 Estado de migraciones verificado');
    
    // Verificar rutas
    $routes = \Route::getRoutes();
    $this->info('🛣️  Rutas registradas: ' . count($routes));
    
    $this->info('🎯 Verificación completada');
})->purpose('Verificar el estado del sistema de bodega');

/**
 * Comando para generar datos de prueba
 * Crea registros de ejemplo para desarrollo
 */
Artisan::command('sistema:seed-demo', function () {
    $this->info('🌱 Generando datos de demostración...');
    
    // Ejecutar seeders de demostración
    $this->call('db:seed', ['--class' => 'DatabaseSeeder']);
    
    $this->info('✅ Datos de demostración generados');
})->purpose('Generar datos de demostración para el sistema');
