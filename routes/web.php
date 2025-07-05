<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;

// ============================================================================
// RUTAS PÚBLICAS (Accesibles sin autenticación)
// ============================================================================

Route::get('/', [ViewController::class, 'login'])->name('login');

/**
 * Página de registro
 */
Route::get('/register', [ViewController::class, 'register'])->name('register');

// ============================================================================
// RUTAS PROTEGIDAS (Requieren autenticación)
// ============================================================================

/**
 * Panel de administración
 * Acceso público temporalmente
 */
Route::get('/admin', function () {
    return view('admin');
})->name('admin'); // SIN middleware('auth')

Route::get('/welcome', [ViewController::class, 'welcome'])->name('welcome')->middleware('auth');

// ============================================================================
// RUTAS DE FALLBACK (Manejo de errores)
// ============================================================================

/**
 * Redirigir rutas no encontradas al login
 */
Route::fallback(function () {
    return redirect()->route('login');
});
