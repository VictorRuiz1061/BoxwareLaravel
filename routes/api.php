<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaElementoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUserAuth;

/**
 * Rutas API del Sistema de Bodega SENA
 * 
 * Este archivo contiene todas las rutas API del sistema de gestión de inventario.
 * Las rutas están organizadas por niveles de acceso y funcionalidad.
 */

// ============================================================================
// RUTAS PÚBLICAS (No requieren autenticación)
// ============================================================================

/**
 * Autenticación de usuarios
 * Permite el registro y login de usuarios sin autenticación previa
 */
Route::post('login', [AuthController::class, 'login'])
    ->name('auth.login')
    ->middleware('throttle:5,1'); // Limitar intentos de login

Route::post('register', [AuthController::class, 'register'])
    ->name('auth.register')
    ->middleware('throttle:3,1'); // Limitar registros

// ============================================================================
// RUTAS PROTEGIDAS (Requieren autenticación)
// ============================================================================

Route::middleware(IsUserAuth::class)->group(function () {
    
    /**
     * Gestión de sesión de usuario
     */
    Route::get('user', [AuthController::class, 'user'])
        ->name('auth.user');
    Route::post('logout', [AuthController::class, 'logout'])
        ->name('auth.logout');

    // ========================================================================
    // RUTAS DE CONSULTA (Accesibles para usuarios autenticados)
    // ========================================================================
    
    /**
     * Catálogos y datos de referencia
     * Solo lectura para usuarios autenticados
     */
    Route::apiResource('categorias-elementos', CategoriaElementoController::class)
        ->only(['index'])
        ->names('categorias-elementos');
    
    Route::apiResource('municipios', App\Http\Controllers\MunicipioController::class)
        ->only(['index'])
        ->names('municipios');
    
    Route::apiResource('centros', App\Http\Controllers\CentroController::class)
        ->only(['index'])
        ->names('centros');
    
    Route::apiResource('sedes', App\Http\Controllers\SedeController::class)
        ->only(['index'])
        ->names('sedes');
    
    Route::apiResource('areas', App\Http\Controllers\AreaController::class)
        ->only(['index'])
        ->names('areas');
    
    Route::apiResource('programas', App\Http\Controllers\ProgramaController::class)
        ->only(['index'])
        ->names('programas');
    
    Route::apiResource('modulos', App\Http\Controllers\ModuloController::class)
        ->only(['index'])
        ->names('modulos');
    
    Route::apiResource('tipo-materiales', App\Http\Controllers\TipoMaterialController::class)
        ->only(['index'])
        ->names('tipo-materiales');
    
    Route::apiResource('caracteristicas', App\Http\Controllers\CaracteristicaController::class)
        ->only(['index'])
        ->names('caracteristicas');
    
    Route::apiResource('tipos-sitio', App\Http\Controllers\TipoSitioController::class)
        ->only(['index'])
        ->names('tipos-sitio');
    
    Route::apiResource('tipos-movimiento', App\Http\Controllers\TipoMovimientoController::class)
        ->only(['index'])
        ->names('tipos-movimiento');

    // ========================================================================
    // RUTAS DE GESTIÓN (CRUD completo para usuarios autorizados)
    // ========================================================================
    
    /**
     * Gestión de inventario y materiales
     */
    Route::apiResource('materiales', App\Http\Controllers\MaterialController::class)
        ->names('materiales');
    
    Route::apiResource('sitios', App\Http\Controllers\SitioController::class)
        ->names('sitios');
    
    Route::apiResource('inventarios', App\Http\Controllers\InventarioController::class)
        ->names('inventarios');
    
    Route::apiResource('movimientos', App\Http\Controllers\MovimientoController::class)
        ->names('movimientos');
    
    Route::apiResource('fichas', App\Http\Controllers\FichaController::class)
        ->names('fichas');

    // ========================================================================
    // RUTAS EXCLUSIVAS PARA ADMINISTRADORES
    // ========================================================================
    
    Route::middleware(IsAdmin::class)->group(function () {
        
        /**
         * Gestión de usuarios y roles
         */
        Route::apiResource('usuarios', UsuarioController::class)
            ->names('usuarios');
        
        Route::apiResource('roles', RolController::class)
            ->names('roles');
        
        /**
         * Gestión de permisos del sistema
         */
        Route::apiResource('permisos', App\Http\Controllers\PermisoController::class)
            ->names('permisos');
        
        /**
         * Gestión completa de catálogos
         */
        Route::apiResource('categorias-elementos', CategoriaElementoController::class)
            ->except(['index'])
            ->names('categorias-elementos.admin');
        
        Route::apiResource('municipios', App\Http\Controllers\MunicipioController::class)
            ->except(['index'])
            ->names('municipios.admin');
        
        Route::apiResource('centros', App\Http\Controllers\CentroController::class)
            ->except(['index'])
            ->names('centros.admin');
        
        Route::apiResource('sedes', App\Http\Controllers\SedeController::class)
            ->except(['index'])
            ->names('sedes.admin');
        
        Route::apiResource('areas', App\Http\Controllers\AreaController::class)
            ->except(['index'])
            ->names('areas.admin');
        
        Route::apiResource('programas', App\Http\Controllers\ProgramaController::class)
            ->except(['index'])
            ->names('programas.admin');
        
        Route::apiResource('modulos', App\Http\Controllers\ModuloController::class)
            ->except(['index'])
            ->names('modulos.admin');
        
        Route::apiResource('tipo-materiales', App\Http\Controllers\TipoMaterialController::class)
            ->except(['index'])
            ->names('tipo-materiales.admin');
        
        Route::apiResource('caracteristicas', App\Http\Controllers\CaracteristicaController::class)
            ->except(['index'])
            ->names('caracteristicas.admin');
        
        Route::apiResource('tipos-sitio', App\Http\Controllers\TipoSitioController::class)
            ->except(['index'])
            ->names('tipos-sitio.admin');
        
        Route::apiResource('tipos-movimiento', App\Http\Controllers\TipoMovimientoController::class)
            ->except(['index'])
            ->names('tipos-movimiento.admin');
    });
});
