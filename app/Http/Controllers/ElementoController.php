<?php

namespace App\Http\Controllers;

use App\Models\CategoriaElemento;
use App\Http\Requests\CategoriaElementoRequest;
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
     * @param CategoriaElementoRequest $request Datos validados de la categoría de elemento a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna la categoría de elemento creada con código de estado 201
     */
    public function store(CategoriaElementoRequest $request)
    {
        try {
            $categoriaElemento = CategoriaElemento::create($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Categoría de elemento creada exitosamente',
                'data' => $categoriaElemento
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la categoría de elemento',
                'error' => $e->getMessage()
            ], 500);
        }
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
     * @param CategoriaElementoRequest $request Datos validados de la categoría de elemento a actualizar
     * @param int $id ID de la categoría de elemento a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna la categoría de elemento actualizada
     */
    public function update(CategoriaElementoRequest $request, $id)
    {
        try {
            $categoriaElemento = CategoriaElemento::findOrFail($id);
            $categoriaElemento->update($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Categoría de elemento actualizada exitosamente',
                'data' => $categoriaElemento
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la categoría de elemento',
                'error' => $e->getMessage()
            ], 500);
        }
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
