# 🛠️ Rutas Adicionales para BodegaSena API

## 📋 Rutas que necesitas agregar a routes/api.php

Agrega estas rutas después de las rutas existentes para que todos los endpoints funcionen:

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\ElementoController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\SitioController;
use App\Http\Controllers\TipoMaterialController;
use App\Http\Controllers\TipoMovimientoController;
use App\Http\Controllers\TipoSitioController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\FichaController;
use App\Http\Controllers\CaracteristicaController;
use App\Http\Controllers\CentroController;
use App\Http\Controllers\MunicipioController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUserAuth;

// ============================================================================
// RUTAS PÚBLICAS (No requieren autenticación)
// ============================================================================

Route::post('login', [AuthController::class, 'login'])
    ->name('auth.login')
    ->middleware('throttle:5,1');

Route::post('register', [AuthController::class, 'register'])
    ->name('auth.register')
    ->middleware('throttle:3,1');

// ============================================================================
// RUTAS PROTEGIDAS (Requieren autenticación)
// ============================================================================

Route::middleware(IsUserAuth::class)->group(function () {
    
    // Autenticación
    Route::get('user', [AuthController::class, 'user'])->name('auth.user');
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

    // Dashboard
    Route::prefix('dashboard')->group(function () {
        Route::get('stats', [ViewController::class, 'getDashboardStats'])->name('dashboard.stats');
        Route::get('inventario', [ViewController::class, 'getInventarioData'])->name('dashboard.inventario');
        Route::get('materiales', [ViewController::class, 'getMaterialesData'])->name('dashboard.materiales');
        Route::get('movimientos', [ViewController::class, 'getMovimientosData'])->name('dashboard.movimientos');
        Route::get('usuarios', [ViewController::class, 'getUsuariosData'])->name('dashboard.usuarios');
        Route::get('charts', [ViewController::class, 'getChartData'])->name('dashboard.charts');
        Route::get('activity', [ViewController::class, 'getRecentActivity'])->name('dashboard.activity');
    });

    // CRUD Completo para todos los módulos
    Route::apiResource('usuarios', UsuarioController::class);
    Route::apiResource('roles', RolController::class);
    Route::apiResource('materiales', MaterialController::class);
    Route::apiResource('areas', AreaController::class);
    Route::apiResource('modulos', ModuloController::class);
    Route::apiResource('permisos', PermisoController::class);
    Route::apiResource('categorias-elementos', ElementoController::class);
    Route::apiResource('movimientos', MovimientoController::class);
    Route::apiResource('inventario', InventarioController::class);
    Route::apiResource('sitios', SitioController::class);
    Route::apiResource('tipos-material', TipoMaterialController::class);
    Route::apiResource('tipos-movimiento', TipoMovimientoController::class);
    Route::apiResource('tipos-sitio', TipoSitioController::class);
    Route::apiResource('sedes', SedeController::class);
    Route::apiResource('programas', ProgramaController::class);
    Route::apiResource('fichas', FichaController::class);
    Route::apiResource('caracteristicas', CaracteristicaController::class);
    Route::apiResource('centros', CentroController::class);
    Route::apiResource('municipios', MunicipioController::class);
});

// ============================================================================
// RUTAS DE FALLBACK (Manejo de errores)
// ============================================================================

Route::fallback(function () {
    return response()->json([
        'success' => false,
        'message' => 'Endpoint no encontrado'
    ], 404);
});
```

## 📝 Explicación de las Rutas

### 🔐 Rutas de Autenticación
- `POST /api/login` - Iniciar sesión
- `POST /api/register` - Registrar nuevo usuario
- `GET /api/user` - Obtener usuario actual
- `POST /api/logout` - Cerrar sesión

### 📊 Rutas de Dashboard
- `GET /api/dashboard/stats` - Estadísticas generales
- `GET /api/dashboard/inventario` - Datos del inventario
- `GET /api/dashboard/materiales` - Datos de materiales
- `GET /api/dashboard/movimientos` - Datos de movimientos
- `GET /api/dashboard/usuarios` - Datos de usuarios
- `GET /api/dashboard/charts` - Datos para gráficos
- `GET /api/dashboard/activity` - Actividad reciente

### 🔄 Rutas CRUD (Con apiResource)
Cada `apiResource` genera automáticamente estas rutas:

| Verbo HTTP | URI | Acción | Nombre de Ruta |
|------------|-----|---------|----------------|
| GET | `/api/usuarios` | index | usuarios.index |
| POST | `/api/usuarios` | store | usuarios.store |
| GET | `/api/usuarios/{id}` | show | usuarios.show |
| PUT/PATCH | `/api/usuarios/{id}` | update | usuarios.update |
| DELETE | `/api/usuarios/{id}` | destroy | usuarios.destroy |

### 📦 Módulos Disponibles
- **usuarios** - Gestión de usuarios
- **roles** - Gestión de roles
- **materiales** - Gestión de materiales
- **areas** - Gestión de áreas
- **modulos** - Gestión de módulos del sistema
- **permisos** - Gestión de permisos
- **categorias-elementos** - Categorías de elementos
- **movimientos** - Movimientos de inventario
- **inventario** - Registros de inventario
- **sitios** - Sitios de almacenamiento
- **tipos-material** - Tipos de materiales
- **tipos-movimiento** - Tipos de movimientos
- **tipos-sitio** - Tipos de sitios
- **sedes** - Sedes del SENA
- **programas** - Programas de formación
- **fichas** - Fichas de formación
- **caracteristicas** - Características de materiales
- **centros** - Centros de formación
- **municipios** - Municipios

## 🛡️ Middleware Aplicado

### IsUserAuth
Se aplica a todas las rutas protegidas para verificar que el usuario esté autenticado.

### Throttle
- **Login**: 5 intentos por minuto
- **Register**: 3 intentos por minuto

## 🚀 Cómo Implementar

1. **Reemplaza** el contenido actual de `routes/api.php` con el código de arriba
2. **Asegúrate** de que todos los controladores existan
3. **Verifica** que los middleware estén configurados
4. **Prueba** las rutas usando Postman o el script de PowerShell

## 📋 Verificación Rápida

Ejecuta este comando para ver todas las rutas disponibles:

```bash
php artisan route:list --name=api
```

O usa el script de PowerShell:

```powershell
.\test_endpoints.ps1
```

¡Con estas rutas tendrás un API completo y funcional para BodegaSena! 🎉 