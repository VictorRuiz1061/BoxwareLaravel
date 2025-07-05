<?php

namespace App\Http\Controllers;

use App\Models\TipoMaterial;
use App\Http\Requests\TipoMaterialRequest;
use Illuminate\Http\Request;

/**
 * Controlador para gestionar los tipos de materiales
 * 
 * Este controlador maneja todas las operaciones CRUD relacionadas con los tipos de materiales,
 * incluyendo la creación, lectura, actualización y eliminación de registros de tipos.
 * Los tipos de materiales categorizan los materiales por sus características específicas.
 */
class TipoMaterialController extends Controller
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
     * Obtener todos los tipos de materiales
     * 
     * @return \Illuminate\Http\JsonResponse
     * Retorna una lista JSON con todos los tipos de materiales registrados
     */
    public function index()
    {
        return response()->json(TipoMaterial::all());
    }

    /**
     * Crear un nuevo tipo de material
     * 
     * @param TipoMaterialRequest $request Datos validados del tipo de material a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna el tipo de material creado con código de estado 201
     */
    public function store(TipoMaterialRequest $request)
    {
        try {
            $tipoMaterial = TipoMaterial::create($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Tipo de material creado exitosamente',
                'data' => $tipoMaterial
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el tipo de material',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener un tipo de material específico por ID
     * 
     * @param int $id ID del tipo de material a buscar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el tipo de material encontrado o error 404 si no existe
     */
    public function show($id)
    {
        $tipoMaterial = TipoMaterial::findOrFail($id);
        return response()->json($tipoMaterial);
    }

    /**
     * Actualizar un tipo de material existente
     * 
     * @param TipoMaterialRequest $request Datos validados del tipo de material a actualizar
     * @param int $id ID del tipo de material a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el tipo de material actualizado
     */
    public function update(TipoMaterialRequest $request, $id)
    {
        try {
            $tipoMaterial = TipoMaterial::findOrFail($id);
            $tipoMaterial->update($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Tipo de material actualizado exitosamente',
                'data' => $tipoMaterial
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el tipo de material',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar un tipo de material
     * 
     * @param int $id ID del tipo de material a eliminar
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta vacía con código de estado 204
     */
    public function destroy($id)
    {
        $tipoMaterial = TipoMaterial::findOrFail($id);
        $tipoMaterial->delete();
        return response()->json(null, 204);
    }
}
