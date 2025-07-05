<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Http\Requests\MaterialRequest;
use Illuminate\Http\Request;

/**
 * Controlador para gestionar los materiales del inventario
 * 
 * Este controlador maneja todas las operaciones CRUD relacionadas con los materiales,
 * incluyendo la creación, lectura, actualización y eliminación de registros de materiales.
 * Los materiales pueden ser perecederos o no, y pertenecen a categorías y tipos específicos.
 */
class MaterialController extends Controller
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
     * Obtener todos los materiales
     * 
     * @return \Illuminate\Http\JsonResponse
     * Retorna una lista JSON con todos los materiales registrados
     */
    public function index()
    {
        return response()->json(Material::all());
    }

    /**
     * Crear un nuevo material
     * 
     * @param MaterialRequest $request Datos validados del material a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna el material creado con código de estado 201
     */
    public function store(MaterialRequest $request)
    {
        try {
            // Los datos ya están validados por el FormRequest
            $material = Material::create($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Material creado exitosamente',
                'data' => $material
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el material',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener un material específico por ID
     * 
     * @param int $id ID del material a buscar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el material encontrado o error 404 si no existe
     */
    public function show($id)
    {
        $material = Material::findOrFail($id);
        return response()->json($material);
    }

    /**
     * Actualizar un material existente
     * 
     * @param MaterialRequest $request Datos validados del material a actualizar
     * @param int $id ID del material a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el material actualizado
     */
    public function update(MaterialRequest $request, $id)
    {
        try {
            $material = Material::findOrFail($id);
            $material->update($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Material actualizado exitosamente',
                'data' => $material
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el material',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar un material
     * 
     * @param int $id ID del material a eliminar
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta vacía con código de estado 204
     */
    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();
        return response()->json(null, 204);
    }
}
