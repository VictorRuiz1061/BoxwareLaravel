<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUserAuth;

// ============================================================================
// RUTAS PÚBLICAS (No requieren autenticación)
// ============================================================================

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
    Route::post('logout-all', [AuthController::class, 'revokeAllTokens'])
        ->name('auth.logout-all');

    /**
     * Rutas del Dashboard
     */
    Route::prefix('dashboard')->group(function () {
        Route::get('stats', [ViewController::class, 'getDashboardStats'])
            ->name('dashboard.stats');
        Route::get('inventario', [ViewController::class, 'getInventarioData'])
            ->name('dashboard.inventario');
        Route::get('materiales', [ViewController::class, 'getMaterialesData'])
            ->name('dashboard.materiales');
        Route::get('movimientos', [ViewController::class, 'getMovimientosData'])
            ->name('dashboard.movimientos');
        Route::get('usuarios', [ViewController::class, 'getUsuariosData'])
            ->name('dashboard.usuarios');
        Route::get('charts', [ViewController::class, 'getChartData'])
            ->name('dashboard.charts');
        Route::get('activity', [ViewController::class, 'getRecentActivity'])
            ->name('dashboard.activity');
    });
});

// ============================================================================
// RUTAS DE FALLBACK (Manejo de errores)
// ============================================================================

/**
 * Ruta para manejar endpoints no encontrados
 */
Route::fallback(function () {
    return response()->json([
        'success' => false,
        'message' => 'Endpoint no encontrado'
    ], 404);
});
