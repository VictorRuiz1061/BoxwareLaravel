<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;

/**
 * Controlador para gestionar los municipios
 * 
 * Este controlador maneja todas las operaciones CRUD relacionadas con los municipios,
 * incluyendo la creación, lectura, actualización y eliminación de registros de municipios.
 * Los municipios representan divisiones administrativas donde se ubican los centros del SENA.
 */
class MunicipioController extends Controller
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
     * Obtener todos los municipios
     * 
     * @return \Illuminate\Http\JsonResponse
     * Retorna una lista JSON con todos los municipios registrados
     */
    public function index()
    {
        return response()->json(Municipio::all());
    }

    /**
     * Crear un nuevo municipio
     * 
     * @param Request $request Datos del municipio a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna el municipio creado con código de estado 201
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre_municipio' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
        ]);

        // Crear el nuevo municipio
        $municipio = Municipio::create($request->all());
        return response()->json($municipio, 201);
    }

    /**
     * Obtener un municipio específico por ID
     * 
     * @param int $id ID del municipio a buscar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el municipio encontrado o error 404 si no existe
     */
    public function show($id)
    {
        $municipio = Municipio::findOrFail($id);
        return response()->json($municipio);
    }

    /**
     * Actualizar un municipio existente
     * 
     * @param Request $request Datos actualizados del municipio
     * @param int $id ID del municipio a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el municipio actualizado
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada (campos opcionales para actualización)
        $request->validate([
            'nombre_municipio' => 'sometimes|string|max:255',
            'estado' => 'sometimes|boolean',
            'fecha_creacion' => 'sometimes|date',
            'fecha_modificacion' => 'sometimes|date',
        ]);

        // Buscar y actualizar el municipio
        $municipio = Municipio::findOrFail($id);
        $municipio->update($request->all());
        return response()->json($municipio);
    }

    /**
     * Eliminar un municipio
     * 
     * @param int $id ID del municipio a eliminar
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta vacía con código de estado 204
     */
    public function destroy($id)
    {
        $municipio = Municipio::findOrFail($id);
        $municipio->delete();
        return response()->json(null, 204);
    }
}
