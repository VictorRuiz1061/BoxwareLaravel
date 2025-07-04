<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
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
     * @param Request $request Datos del inventario a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna el registro de inventario creado con código de estado 201
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'stock' => 'required|integer',
            'placa_sena' => 'required|string',
            'descripcion' => 'required|string',
            'sitio_id' => 'required|exists:sitios,id_sitio',
        ]);

        // Crear el nuevo registro de inventario
        $inventario = Inventario::create($request->all());
        return response()->json($inventario, 201);
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
     * @param Request $request Datos actualizados del inventario
     * @param int $id ID del inventario a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el registro de inventario actualizado
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada (campos opcionales para actualización)
        $request->validate([
            'stock' => 'sometimes|integer',
            'placa_sena' => 'sometimes|string',
            'descripcion' => 'sometimes|string',
            'sitio_id' => 'sometimes|exists:sitios,id_sitio',
        ]);

        // Buscar y actualizar el registro de inventario
        $inventario = Inventario::findOrFail($id);
        $inventario->update($request->all());
        return response()->json($inventario);
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
