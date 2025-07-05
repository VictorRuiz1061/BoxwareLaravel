<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Http\Requests\InventarioRequest;
use Illuminate\Http\Request;

/**
 * Controlador para gestionar el inventario de materiales
 * 
 * Este controlador maneja todas las operaciones CRUD relacionadas con el inventario,
 * incluyendo la creación, lectura, actualización y eliminación de registros de inventario.
 * El inventario controla el stock de materiales en diferentes sitios.
 */
class InventarioController extends Controller
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
     * Obtener todo el inventario
     * 
     * @return \Illuminate\Http\JsonResponse
     * Retorna una lista JSON con todos los registros de inventario
     */
    public function index()
    {
        return response()->json(Inventario::all());
    }

    /**
     * Crear un nuevo registro de inventario
     * 
     * @param InventarioRequest $request Datos validados del inventario a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna el registro de inventario creado con código de estado 201
     */
    public function store(InventarioRequest $request)
    {
        try {
            $inventario = Inventario::create($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Registro de inventario creado exitosamente',
                'data' => $inventario
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el registro de inventario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener un registro de inventario específico por ID
     * 
     * @param int $id ID del inventario a buscar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el registro de inventario encontrado o error 404 si no existe
     */
    public function show($id)
    {
        $inventario = Inventario::findOrFail($id);
        return response()->json($inventario);
    }

    /**
     * Actualizar un registro de inventario existente
     * 
     * @param InventarioRequest $request Datos validados del inventario a actualizar
     * @param int $id ID del inventario a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el registro de inventario actualizado
     */
    public function update(InventarioRequest $request, $id)
    {
        try {
            $inventario = Inventario::findOrFail($id);
            $inventario->update($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Registro de inventario actualizado exitosamente',
                'data' => $inventario
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el registro de inventario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar un registro de inventario
     * 
     * @param int $id ID del inventario a eliminar
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta vacía con código de estado 204
     */
    public function destroy($id)
    {
        $inventario = Inventario::findOrFail($id);
        $inventario->delete();
        return response()->json(null, 204);
    }
}
