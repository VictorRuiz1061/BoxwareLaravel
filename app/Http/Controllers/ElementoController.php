<?php

namespace App\Http\Controllers;

use App\Models\CategoriaElemento;
use Illuminate\Http\Request;

/**
 * Controlador para gestionar las categorías de elementos
 * 
 * Este controlador maneja todas las operaciones CRUD relacionadas con las categorías de elementos,
 * incluyendo la creación, lectura, actualización y eliminación de registros de categorías.
 * Las categorías de elementos clasifican los materiales por su tipo y función.
 */
class ElementoController extends Controller
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
     * Obtener todas las categorías de elementos
     * 
     * @return \Illuminate\Http\JsonResponse
     * Retorna una lista JSON con todas las categorías de elementos registradas
     */
    public function index()
    {
        return response()->json(CategoriaElemento::all());
    }

    /**
     * Crear una nueva categoría de elemento
     * 
     * @param Request $request Datos de la categoría de elemento a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna la categoría de elemento creada con código de estado 201
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre_categoria' => 'required|string|max:255',
            'descripcion_categoria' => 'required|string',
            'estado' => 'required|boolean',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
        ]);

        // Crear la nueva categoría de elemento
        $categoriaElemento = CategoriaElemento::create($request->all());
        return response()->json($categoriaElemento, 201);
    }

    /**
     * Obtener una categoría de elemento específica por ID
     * 
     * @param int $id ID de la categoría de elemento a buscar
     * @return \Illuminate\Http\JsonResponse
     * Retorna la categoría de elemento encontrada o error 404 si no existe
     */
    public function show($id)
    {
        $categoriaElemento = CategoriaElemento::findOrFail($id);
        return response()->json($categoriaElemento);
    }

    /**
     * Actualizar una categoría de elemento existente
     * 
     * @param Request $request Datos actualizados de la categoría de elemento
     * @param int $id ID de la categoría de elemento a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna la categoría de elemento actualizada
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada (campos opcionales para actualización)
        $request->validate([
            'nombre_categoria' => 'sometimes|string|max:255',
            'descripcion_categoria' => 'sometimes|string',
            'estado' => 'sometimes|boolean',
            'fecha_creacion' => 'sometimes|date',
            'fecha_modificacion' => 'sometimes|date',
        ]);

        // Buscar y actualizar la categoría de elemento
        $categoriaElemento = CategoriaElemento::findOrFail($id);
        $categoriaElemento->update($request->all());
        return response()->json($categoriaElemento);
    }

    /**
     * Eliminar una categoría de elemento
     * 
     * @param int $id ID de la categoría de elemento a eliminar
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta vacía con código de estado 204
     */
    public function destroy($id)
    {
        $categoriaElemento = CategoriaElemento::findOrFail($id);
        $categoriaElemento->delete();
        return response()->json(null, 204);
    }
}
