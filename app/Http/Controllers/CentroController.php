<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use Illuminate\Http\Request;

/**
 * Controlador para gestionar los centros del SENA
 * 
 * Este controlador maneja todas las operaciones CRUD relacionadas con los centros,
 * incluyendo la creación, lectura, actualización y eliminación de registros.
 */
class CentroController extends Controller
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
     * Obtener todos los centros
     * 
     * @return \Illuminate\Http\JsonResponse
     * Retorna una lista JSON con todos los centros registrados
     */
    public function index()
    {
        return response()->json(Centro::all());
    }

    /**
     * Crear un nuevo centro
     * 
     * @param Request $request Datos del centro a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna el centro creado con código de estado 201
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre_centro' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
            'municipio_id' => 'required|exists:municipios,id_municipio',
        ]);

        // Crear el nuevo centro
        $centro = Centro::create($request->all());
        return response()->json($centro, 201);
    }

    /**
     * Obtener un centro específico por ID
     * 
     * @param int $id ID del centro a buscar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el centro encontrado o error 404 si no existe
     */
    public function show($id)
    {
        $centro = Centro::findOrFail($id);
        return response()->json($centro);
    }

    /**
     * Actualizar un centro existente
     * 
     * @param Request $request Datos actualizados del centro
     * @param int $id ID del centro a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el centro actualizado
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada (campos opcionales para actualización)
        $request->validate([
            'nombre_centro' => 'sometimes|string|max:255',
            'estado' => 'sometimes|boolean',
            'fecha_creacion' => 'sometimes|date',
            'fecha_modificacion' => 'sometimes|date',
            'municipio_id' => 'sometimes|exists:municipios,id_municipio',
        ]);

        // Buscar y actualizar el centro
        $centro = Centro::findOrFail($id);
        $centro->update($request->all());
        return response()->json($centro);
    }

    /**
     * Eliminar un centro
     * 
     * @param int $id ID del centro a eliminar
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta vacía con código de estado 204
     */
    public function destroy($id)
    {
        $centro = Centro::findOrFail($id);
        $centro->delete();
        return response()->json(null, 204);
    }
} 