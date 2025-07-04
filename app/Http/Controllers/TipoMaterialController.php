<?php

namespace App\Http\Controllers;

use App\Models\TipoMaterial;
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
     * @param Request $request Datos del tipo de material a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna el tipo de material creado con código de estado 201
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre_tipo_material' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
        ]);

        // Crear el nuevo tipo de material
        $tipoMaterial = TipoMaterial::create($request->all());
        return response()->json($tipoMaterial, 201);
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
     * @param Request $request Datos actualizados del tipo de material
     * @param int $id ID del tipo de material a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el tipo de material actualizado
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada (campos opcionales para actualización)
        $request->validate([
            'nombre_tipo_material' => 'sometimes|string|max:255',
            'estado' => 'sometimes|boolean',
            'fecha_creacion' => 'sometimes|date',
            'fecha_modificacion' => 'sometimes|date',
        ]);

        // Buscar y actualizar el tipo de material
        $tipoMaterial = TipoMaterial::findOrFail($id);
        $tipoMaterial->update($request->all());
        return response()->json($tipoMaterial);
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
