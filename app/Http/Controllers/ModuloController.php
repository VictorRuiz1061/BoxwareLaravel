<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Http\Requests\ModuloRequest;
use Illuminate\Http\Request;

/**
 * Controlador para gestionar los módulos del sistema
 * 
 * Este controlador maneja todas las operaciones CRUD relacionadas con los módulos,
 * incluyendo la creación, lectura, actualización y eliminación de registros de módulos.
 * Los módulos representan secciones funcionales del sistema con rutas específicas.
 */
class ModuloController extends Controller
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
     * Obtener todos los módulos
     * 
     * @return \Illuminate\Http\JsonResponse
     * Retorna una lista JSON con todos los módulos registrados
     */
    public function index()
    {
        return response()->json(Modulo::all());
    }

    /**
     * Crear un nuevo módulo
     * 
     * @param ModuloRequest $request Datos validados del módulo a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna el módulo creado con código de estado 201
     */
    public function store(ModuloRequest $request)
    {
        try {
            $modulo = Modulo::create($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Módulo creado exitosamente',
                'data' => $modulo
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el módulo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener un módulo específico por ID
     * 
     * @param int $id ID del módulo a buscar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el módulo encontrado o error 404 si no existe
     */
    public function show($id)
    {
        $modulo = Modulo::findOrFail($id);
        return response()->json($modulo);
    }

    /**
     * Actualizar un módulo existente
     * 
     * @param ModuloRequest $request Datos validados del módulo a actualizar
     * @param int $id ID del módulo a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el módulo actualizado
     */
    public function update(ModuloRequest $request, $id)
    {
        try {
            $modulo = Modulo::findOrFail($id);
            $modulo->update($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Módulo actualizado exitosamente',
                'data' => $modulo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el módulo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar un módulo
     * 
     * @param int $id ID del módulo a eliminar
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta vacía con código de estado 204
     */
    public function destroy($id)
    {
        $modulo = Modulo::findOrFail($id);
        $modulo->delete();
        return response()->json(null, 204);
    }
}
