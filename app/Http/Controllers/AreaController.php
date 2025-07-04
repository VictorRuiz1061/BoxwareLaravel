<?php

namespace App\Http\Controllers;

use App\Models\Area;
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
     * @param Request $request Datos del área a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna el área creada con código de estado 201
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre_area' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
            'sede_id' => 'required|exists:sedes,id_sede',
        ]);

        // Crear la nueva área
        $area = Area::create($request->all());
        return response()->json($area, 201);
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
     * @param Request $request Datos actualizados del área
     * @param int $id ID del área a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el área actualizada
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada (campos opcionales para actualización)
        $request->validate([
            'nombre_area' => 'sometimes|string|max:255',
            'estado' => 'sometimes|boolean',
            'fecha_creacion' => 'sometimes|date',
            'fecha_modificacion' => 'sometimes|date',
            'sede_id' => 'sometimes|exists:sedes,id_sede',
        ]);

        // Buscar y actualizar el área
        $area = Area::findOrFail($id);
        $area->update($request->all());
        return response()->json($area);
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
