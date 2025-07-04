<?php

use Illuminate\Support\Facades\Route;

/**
 * Rutas Web del Sistema de Bodega SENA
 * 
 * Este archivo contiene las rutas web que sirven las vistas del sistema.
 * Las rutas están organizadas por funcionalidad y acceso.
 */

// ============================================================================
// RUTAS PÚBLICAS (Accesibles sin autenticación)
// ============================================================================

/**
 * Página principal - Redirige al login
 */
Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

/**
 * Página de login
 */
Route::get('/login', function () {
    return view('login');
})->name('login');

// ============================================================================
// RUTAS PROTEGIDAS (Requieren autenticación)
// ============================================================================

/**
 * Panel de administración
 * Solo accesible para usuarios autenticados
 */
Route::get('/admin', function () {
    return view('admin');
})->name('admin')->middleware('auth');

/**
 * Página de bienvenida
 */
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome')->middleware('auth');

// ============================================================================
// RUTAS DE FALLBACK (Manejo de errores)
// ============================================================================

/**
 * Redirigir rutas no encontradas al login
 */
Route::fallback(function () {
    return redirect()->route('login');
});
