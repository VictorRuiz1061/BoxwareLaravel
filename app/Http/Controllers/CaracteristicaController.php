<?php

namespace App\Http\Controllers;

use App\Models\Caracteristica;
use Illuminate\Http\Request;

/**
 * Controlador para gestionar las características de los materiales
 * 
 * Este controlador maneja todas las operaciones CRUD relacionadas con las características,
 * incluyendo la creación, lectura, actualización y eliminación de registros de características.
 * Las características describen propiedades específicas de los materiales.
 */
class CaracteristicaController extends Controller
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
     * Obtener todas las características
     * 
     * @return \Illuminate\Http\JsonResponse
     * Retorna una lista JSON con todas las características registradas
     */
    public function index()
    {
        return response()->json(Caracteristica::all());
    }

    /**
     * Crear una nueva característica
     * 
     * @param Request $request Datos de la característica a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna la característica creada con código de estado 201
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre_caracteristica' => 'required|string|max:255',
            'descripcion_caracteristica' => 'required|string',
            'estado' => 'required|boolean',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
        ]);

        // Crear la nueva característica
        $caracteristica = Caracteristica::create($request->all());
        return response()->json($caracteristica, 201);
    }

    /**
     * Obtener una característica específica por ID
     * 
     * @param int $id ID de la característica a buscar
     * @return \Illuminate\Http\JsonResponse
     * Retorna la característica encontrada o error 404 si no existe
     */
    public function show($id)
    {
        $caracteristica = Caracteristica::findOrFail($id);
        return response()->json($caracteristica);
    }

    /**
     * Actualizar una característica existente
     * 
     * @param Request $request Datos actualizados de la característica
     * @param int $id ID de la característica a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna la característica actualizada
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada (campos opcionales para actualización)
        $request->validate([
            'nombre_caracteristica' => 'sometimes|string|max:255',
            'descripcion_caracteristica' => 'sometimes|string',
            'estado' => 'sometimes|boolean',
            'fecha_creacion' => 'sometimes|date',
            'fecha_modificacion' => 'sometimes|date',
        ]);

        // Buscar y actualizar la característica
        $caracteristica = Caracteristica::findOrFail($id);
        $caracteristica->update($request->all());
        return response()->json($caracteristica);
    }

    /**
     * Eliminar una característica
     * 
     * @param int $id ID de la característica a eliminar
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta vacía con código de estado 204
     */
    public function destroy($id)
    {
        $caracteristica = Caracteristica::findOrFail($id);
        $caracteristica->delete();
        return response()->json(null, 204);
    }
}
