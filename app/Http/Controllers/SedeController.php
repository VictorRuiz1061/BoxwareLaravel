<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use Illuminate\Http\Request;

/**
 * Controlador para gestionar las sedes del SENA
 * 
 * Este controlador maneja todas las operaciones CRUD relacionadas con las sedes,
 * incluyendo la creación, lectura, actualización y eliminación de registros de sedes.
 * Las sedes representan ubicaciones físicas donde se imparten programas de formación.
 */
class SedeController extends Controller
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
     * Obtener todas las sedes
     * 
     * @return \Illuminate\Http\JsonResponse
     * Retorna una lista JSON con todas las sedes registradas
     */
    public function index()
    {
        return response()->json(Sede::all());
    }

    /**
     * Crear una nueva sede
     * 
     * @param Request $request Datos de la sede a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna la sede creada con código de estado 201
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre_sede' => 'required|string|max:255',
            'direccion_sede' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'centro_id' => 'required|exists:centros,id_centro',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
        ]);

        // Crear la nueva sede
        $sede = Sede::create($request->all());
        return response()->json($sede, 201);
    }

    /**
     * Obtener una sede específica por ID
     * 
     * @param int $id ID de la sede a buscar
     * @return \Illuminate\Http\JsonResponse
     * Retorna la sede encontrada o error 404 si no existe
     */
    public function show($id)
    {
        $sede = Sede::findOrFail($id);
        return response()->json($sede);
    }

    /**
     * Actualizar una sede existente
     * 
     * @param Request $request Datos actualizados de la sede
     * @param int $id ID de la sede a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna la sede actualizada
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada (campos opcionales para actualización)
        $request->validate([
            'nombre_sede' => 'sometimes|string|max:255',
            'direccion_sede' => 'sometimes|string|max:255',
            'estado' => 'sometimes|boolean',
            'centro_id' => 'sometimes|exists:centros,id_centro',
            'fecha_creacion' => 'sometimes|date',
            'fecha_modificacion' => 'sometimes|date',
        ]);

        // Buscar y actualizar la sede
        $sede = Sede::findOrFail($id);
        $sede->update($request->all());
        return response()->json($sede);
    }

    /**
     * Eliminar una sede
     * 
     * @param int $id ID de la sede a eliminar
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta vacía con código de estado 204
     */
    public function destroy($id)
    {
        $sede = Sede::findOrFail($id);
        $sede->delete();
        return response()->json(null, 204);
    }
}
