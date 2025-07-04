<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Movimiento;
use App\Models\Usuario;
use App\Models\Inventario;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * Controlador para manejar las vistas del sistema
 * 
 * Este controlador se encarga de renderizar las vistas principales
 * del sistema y proporcionar datos para el dashboard.
 */
class ViewController extends Controller
{
    /**
     * Mostrar la página de bienvenida
     * 
     * @return \Illuminate\View\View
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     * Mostrar la página de login
     * 
     * @return \Illuminate\View\View
     */
    public function login()
    {
        return view('login');
    }

    /**
     * Mostrar la página de registro
     * 
     * @return \Illuminate\View\View
     */
    public function register()
    {
        return view('register');
    }

    /**
     * Mostrar el dashboard administrativo
     * 
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Verificar si el usuario está autenticado
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        return view('admin');
    }

    /**
     * Obtener estadísticas del dashboard
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDashboardStats()
    {
        try {
            // Obtener estadísticas básicas
            $stats = [
                'total_materiales' => Material::count(),
                'movimientos_hoy' => Movimiento::whereDate('fecha', Carbon::today())->count(),
                'stock_bajo' => Inventario::where('cantidad', '<', 10)->count(),
                'usuarios_activos' => Usuario::where('estado', true)->count(),
            ];

            return response()->json($stats);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al cargar las estadísticas',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener datos de inventario para el dashboard
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInventarioData()
    {
        try {
            $inventario = Inventario::with(['material', 'sitio'])
                ->orderBy('cantidad', 'asc')
                ->limit(10)
                ->get();

            return response()->json($inventario);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al cargar datos de inventario',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener datos de materiales para el dashboard
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMaterialesData()
    {
        try {
            $materiales = Material::with('tipo_material')
                ->orderBy('created_at', 'desc')
                ->limit(12)
                ->get();

            return response()->json($materiales);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al cargar datos de materiales',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener datos de movimientos para el dashboard
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMovimientosData()
    {
        try {
            $movimientos = Movimiento::with(['material', 'usuario', 'tipo_movimiento'])
                ->orderBy('fecha', 'desc')
                ->limit(10)
                ->get();

            return response()->json($movimientos);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al cargar datos de movimientos',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener datos de usuarios para el dashboard
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsuariosData()
    {
        try {
            $usuarios = Usuario::with('rol')
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();

            return response()->json($usuarios);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al cargar datos de usuarios',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener datos para gráficos del dashboard
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChartData()
    {
        try {
            // Datos de movimientos por día de la semana
            $movimientosPorDia = Movimiento::selectRaw('DAYOFWEEK(fecha) as dia, COUNT(*) as total')
                ->whereBetween('fecha', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->groupBy('dia')
                ->get();

            // Datos de stock por categoría
            $stockPorCategoria = DB::table('inventario')
                ->join('materiales', 'inventario.material_id', '=', 'materiales.id')
                ->join('tipo_materiales', 'materiales.tipo_material_id', '=', 'tipo_materiales.id')
                ->selectRaw('tipo_materiales.nombre as categoria, SUM(inventario.cantidad) as total')
                ->groupBy('tipo_materiales.id', 'tipo_materiales.nombre')
                ->get();

            return response()->json([
                'movimientos_por_dia' => $movimientosPorDia,
                'stock_por_categoria' => $stockPorCategoria
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al cargar datos de gráficos',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener actividad reciente
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRecentActivity()
    {
        try {
            $actividad = Movimiento::with(['material', 'usuario', 'tipo_movimiento'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get()
                ->map(function ($movimiento) {
                    return [
                        'id' => $movimiento->id,
                        'tipo' => $movimiento->tipo_movimiento->nombre,
                        'material' => $movimiento->material->nombre,
                        'cantidad' => $movimiento->cantidad,
                        'usuario' => $movimiento->usuario->nombre_usuario,
                        'fecha' => $movimiento->created_at->diffForHumans(),
                        'icon' => $movimiento->tipo_movimiento->nombre === 'Entrada' ? 'fas fa-arrow-down' : 'fas fa-arrow-up',
                        'color' => $movimiento->tipo_movimiento->nombre === 'Entrada' ? 'text-green-600' : 'text-red-600'
                    ];
                });

            return response()->json($actividad);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al cargar actividad reciente',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mostrar página de configuración
     * 
     * @return \Illuminate\View\View
     */
    public function configuracion()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        return view('admin'); // Usar la misma vista admin pero con sección de configuración
    }

    /**
     * Mostrar página de reportes
     * 
     * @return \Illuminate\View\View
     */
    public function reportes()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        return view('admin'); // Usar la misma vista admin pero con sección de reportes
    }
} 