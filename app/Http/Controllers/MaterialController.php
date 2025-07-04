<?php

namespace App\Http\Controllers;

use App\Models\Material;
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
     * @param Request $request Datos del material a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna el material creado con código de estado 201
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'codigo_sena' => 'required|string|max:100',
            'nombre_material' => 'required|string|max:255',
            'descripcion_material' => 'required|string',
            'unidad_medida' => 'required|string|max:100',
            'producto_peresedero' => 'required|boolean',
            'estado' => 'required|boolean',
            'fecha_vencimiento' => 'required|date',
            'imagen' => 'nullable|string',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
            'categoria_id' => 'required|exists:categorias_elementos,id_categoria_elemento',
            'tipo_material_id' => 'required|exists:tipo_materiales,id_tipo_material',
        ]);

        // Crear el nuevo material
        $material = Material::create($request->all());
        return response()->json($material, 201);
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
     * @param Request $request Datos actualizados del material
     * @param int $id ID del material a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el material actualizado
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada (campos opcionales para actualización)
        $request->validate([
            'codigo_sena' => 'sometimes|string|max:100',
            'nombre_material' => 'sometimes|string|max:255',
            'descripcion_material' => 'sometimes|string',
            'unidad_medida' => 'sometimes|string|max:100',
            'producto_peresedero' => 'sometimes|boolean',
            'estado' => 'sometimes|boolean',
            'fecha_vencimiento' => 'sometimes|date',
            'imagen' => 'nullable|string',
            'fecha_creacion' => 'sometimes|date',
            'fecha_modificacion' => 'sometimes|date',
            'categoria_id' => 'sometimes|exists:categorias_elementos,id_categoria_elemento',
            'tipo_material_id' => 'sometimes|exists:tipo_materiales,id_tipo_material',
        ]);

        // Buscar y actualizar el material
        $material = Material::findOrFail($id);
        $material->update($request->all());
        return response()->json($material);
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
