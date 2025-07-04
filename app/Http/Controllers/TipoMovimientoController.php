<?php

namespace App\Http\Controllers;

use App\Models\TipoMovimiento;
use Illuminate\Http\Request;

/**
 * Controlador para gestionar los tipos de movimientos
 * 
 * Este controlador maneja todas las operaciones CRUD relacionadas con los tipos de movimientos,
 * incluyendo la creación, lectura, actualización y eliminación de registros de tipos.
 * Los tipos de movimientos categorizan las entradas y salidas del inventario.
 */
class TipoMovimientoController extends Controller
{
    /**
     * Constructor del controlador
     * Aplica middleware de autenticación a todas las rutas
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Obtener todos los tipos de movimientos
     * 
     * @return \Illuminate\Http\JsonResponse
     * Retorna una lista JSON con todos los tipos de movimientos registrados
     */
    public function index()
    {
        return response()->json(TipoMovimiento::all());
    }

    /**
     * Crear un nuevo tipo de movimiento
     * 
     * @param Request $request Datos del tipo de movimiento a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna el tipo de movimiento creado con código de estado 201
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre_tipo_movimiento' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
        ]);

        // Crear el nuevo tipo de movimiento
        $tipoMovimiento = TipoMovimiento::create($request->all());
        return response()->json($tipoMovimiento, 201);
    }

    /**
     * Obtener un tipo de movimiento específico por ID
     * 
     * @param int $id ID del tipo de movimiento a buscar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el tipo de movimiento encontrado o error 404 si no existe
     */
    public function show($id)
    {
        $tipoMovimiento = TipoMovimiento::findOrFail($id);
        return response()->json($tipoMovimiento);
    }

    /**
     * Actualizar un tipo de movimiento existente
     * 
     * @param Request $request Datos actualizados del tipo de movimiento
     * @param int $id ID del tipo de movimiento a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el tipo de movimiento actualizado
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada (campos opcionales para actualización)
        $request->validate([
            'nombre_tipo_movimiento' => 'sometimes|string|max:255',
            'estado' => 'sometimes|boolean',
            'fecha_creacion' => 'sometimes|date',
            'fecha_modificacion' => 'sometimes|date',
        ]);

        // Buscar y actualizar el tipo de movimiento
        $tipoMovimiento = TipoMovimiento::findOrFail($id);
        $tipoMovimiento->update($request->all());
        return response()->json($tipoMovimiento);
    }

    /**
     * Eliminar un tipo de movimiento
     * 
     * @param int $id ID del tipo de movimiento a eliminar
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta vacía con código de estado 204
     */
    public function destroy($id)
    {
        $tipoMovimiento = TipoMovimiento::findOrFail($id);
        $tipoMovimiento->delete();
        return response()->json(null, 204);
    }
}
