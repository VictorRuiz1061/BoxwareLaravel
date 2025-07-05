<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Http\Requests\AreaRequest;
use Illuminate\Http\Request;

/**
 * Controlador para gestionar las áreas de formación
 * 
 * Este controlador maneja todas las operaciones CRUD relacionadas con las áreas,
 * incluyendo la creación, lectura, actualización y eliminación de registros de áreas.
 * Las áreas representan divisiones temáticas de formación en el SENA.
 */
class AreaController extends Controller
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
     * Obtener todas las áreas
     * 
     * @return \Illuminate\Http\JsonResponse
     * Retorna una lista JSON con todas las áreas registradas
     */
    public function index()
    {
        return response()->json(Area::all());
    }

    /**
     * Crear una nueva área
     * 
     * @param AreaRequest $request Datos validados del área a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna el área creada con código de estado 201
     */
    public function store(AreaRequest $request)
    {
        try {
            $area = Area::create($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Área creada exitosamente',
                'data' => $area
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el área',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener un área específica por ID
     * 
     * @param int $id ID del área a buscar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el área encontrada o error 404 si no existe
     */
    public function show($id)
    {
        $area = Area::findOrFail($id);
        return response()->json($area);
    }

    /**
     * Actualizar un área existente
     * 
     * @param AreaRequest $request Datos validados del área a actualizar
     * @param int $id ID del área a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el área actualizada
     */
    public function update(AreaRequest $request, $id)
    {
        try {
            $area = Area::findOrFail($id);
            $area->update($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Área actualizada exitosamente',
                'data' => $area
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el área',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar un área
     * 
     * @param int $id ID del área a eliminar
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta vacía con código de estado 204
     */
    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();
        return response()->json(null, 204);
    }
}
