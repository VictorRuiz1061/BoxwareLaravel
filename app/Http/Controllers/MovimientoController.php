<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use Illuminate\Http\Request;

/**
 * Controlador para gestionar los movimientos de inventario
 * 
 * Este controlador maneja todas las operaciones CRUD relacionadas con los movimientos,
 * incluyendo la creación, lectura, actualización y eliminación de registros de movimientos.
 * Los movimientos representan entradas y salidas de materiales del inventario.
 */
class MovimientoController extends Controller
{
    /**
     * Obtener todos los movimientos
     * 
     * @return \Illuminate\Http\JsonResponse
     * Retorna una lista JSON con todos los movimientos registrados
     */
    public function index()
    {
        return response()->json(Movimiento::all());
    }

    /**
     * Crear un nuevo movimiento
     * 
     * @param Request $request Datos del movimiento a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna el movimiento creado con código de estado 201
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'estado' => 'required|boolean',
            'cantidad' => 'required|integer',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
            'tipo_movimiento_id' => 'required|exists:tipos_movimiento,id_tipo_movimiento',
            'material_id' => 'required|exists:materiales,id_material',
        ]);

        // Crear el nuevo movimiento
        $movimiento = Movimiento::create($request->all());
        return response()->json($movimiento, 201);
    }

    /**
     * Obtener un movimiento específico por ID
     * 
     * @param int $id ID del movimiento a buscar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el movimiento encontrado o error 404 si no existe
     */
    public function show($id)
    {
        $movimiento = Movimiento::findOrFail($id);
        return response()->json($movimiento);
    }

    /**
     * Actualizar un movimiento existente
     * 
     * @param Request $request Datos actualizados del movimiento
     * @param int $id ID del movimiento a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el movimiento actualizado
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada (campos opcionales para actualización)
        $request->validate([
            'estado' => 'sometimes|boolean',
            'cantidad' => 'sometimes|integer',
            'fecha_creacion' => 'sometimes|date',
            'fecha_modificacion' => 'sometimes|date',
            'tipo_movimiento_id' => 'sometimes|exists:tipos_movimiento,id_tipo_movimiento',
            'material_id' => 'sometimes|exists:materiales,id_material',
        ]);

        // Buscar y actualizar el movimiento
        $movimiento = Movimiento::findOrFail($id);
        $movimiento->update($request->all());
        return response()->json($movimiento);
    }

    /**
     * Eliminar un movimiento
     * 
     * @param int $id ID del movimiento a eliminar
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta vacía con código de estado 204
     */
    public function destroy($id)
    {
        $movimiento = Movimiento::findOrFail($id);
        $movimiento->delete();
        return response()->json(null, 204);
    }
}
