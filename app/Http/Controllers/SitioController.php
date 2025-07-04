<?php

namespace App\Http\Controllers;

use App\Models\Sitio;
use Illuminate\Http\Request;

/**
 * Controlador para gestionar los sitios de almacenamiento
 * 
 * Este controlador maneja todas las operaciones CRUD relacionadas con los sitios,
 * incluyendo la creación, lectura, actualización y eliminación de registros de sitios.
 * Los sitios representan ubicaciones físicas donde se almacenan los materiales.
 */
class SitioController extends Controller
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
     * Obtener todos los sitios
     * 
     * @return \Illuminate\Http\JsonResponse
     * Retorna una lista JSON con todos los sitios registrados
     */
    public function index()
    {
        return response()->json(Sitio::all());
    }

    /**
     * Crear un nuevo sitio
     * 
     * @param Request $request Datos del sitio a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna el sitio creado con código de estado 201
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre_sitio' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'ficha_tecnica' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'tipo_sitio_id' => 'required|exists:tipos_sitio,id_tipo_sitio',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
        ]);

        // Crear el nuevo sitio
        $sitio = Sitio::create($request->all());
        return response()->json($sitio, 201);
    }

    /**
     * Obtener un sitio específico por ID
     * 
     * @param int $id ID del sitio a buscar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el sitio encontrado o error 404 si no existe
     */
    public function show($id)
    {
        $sitio = Sitio::findOrFail($id);
        return response()->json($sitio);
    }

    /**
     * Actualizar un sitio existente
     * 
     * @param Request $request Datos actualizados del sitio
     * @param int $id ID del sitio a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el sitio actualizado
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada (campos opcionales para actualización)
        $request->validate([
            'nombre_sitio' => 'sometimes|string|max:255',
            'ubicacion' => 'sometimes|string|max:255',
            'ficha_tecnica' => 'sometimes|string|max:255',
            'estado' => 'sometimes|boolean',
            'tipo_sitio_id' => 'sometimes|exists:tipos_sitio,id_tipo_sitio',
            'fecha_creacion' => 'sometimes|date',
            'fecha_modificacion' => 'sometimes|date',
        ]);

        // Buscar y actualizar el sitio
        $sitio = Sitio::findOrFail($id);
        $sitio->update($request->all());
        return response()->json($sitio);
    }

    /**
     * Eliminar un sitio
     * 
     * @param int $id ID del sitio a eliminar
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta vacía con código de estado 204
     */
    public function destroy($id)
    {
        $sitio = Sitio::findOrFail($id);
        $sitio->delete();
        return response()->json(null, 204);
    }
}
