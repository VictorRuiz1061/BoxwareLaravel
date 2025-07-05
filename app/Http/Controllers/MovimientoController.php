<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use App\Http\Requests\MovimientoRequest;
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
     * @param MovimientoRequest $request Datos validados del movimiento a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna el movimiento creado con código de estado 201
     */
    public function store(MovimientoRequest $request)
    {
        try {
            $movimiento = Movimiento::create($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Movimiento creado exitosamente',
                'data' => $movimiento
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el movimiento',
                'error' => $e->getMessage()
            ], 500);
        }
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
     * @param MovimientoRequest $request Datos validados del movimiento a actualizar
     * @param int $id ID del movimiento a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el movimiento actualizado
     */
    public function update(MovimientoRequest $request, $id)
    {
        try {
            $movimiento = Movimiento::findOrFail($id);
            $movimiento->update($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Movimiento actualizado exitosamente',
                'data' => $movimiento
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el movimiento',
                'error' => $e->getMessage()
            ], 500);
        }
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
