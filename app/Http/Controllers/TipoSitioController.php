<?php

namespace App\Http\Controllers;

use App\Models\TipoSitio;
use Illuminate\Http\Request;

/**
 * Controlador para gestionar los tipos de sitios
 * 
 * Este controlador maneja todas las operaciones CRUD relacionadas con los tipos de sitios,
 * incluyendo la creación, lectura, actualización y eliminación de registros de tipos.
 * Los tipos de sitios categorizan las ubicaciones de almacenamiento por su función.
 */
class TipoSitioController extends Controller
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
     * Obtener todos los tipos de sitios
     * 
     * @return \Illuminate\Http\JsonResponse
     * Retorna una lista JSON con todos los tipos de sitios registrados
     */
    public function index()
    {
        return response()->json(TipoSitio::all());
    }

    /**
     * Crear un nuevo tipo de sitio
     * 
     * @param Request $request Datos del tipo de sitio a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna el tipo de sitio creado con código de estado 201
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre_tipo_sitio' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
        ]);

        // Crear el nuevo tipo de sitio
        $tipoSitio = TipoSitio::create($request->all());
        return response()->json($tipoSitio, 201);
    }

    /**
     * Obtener un tipo de sitio específico por ID
     * 
     * @param int $id ID del tipo de sitio a buscar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el tipo de sitio encontrado o error 404 si no existe
     */
    public function show($id)
    {
        $tipoSitio = TipoSitio::findOrFail($id);
        return response()->json($tipoSitio);
    }

    /**
     * Actualizar un tipo de sitio existente
     * 
     * @param Request $request Datos actualizados del tipo de sitio
     * @param int $id ID del tipo de sitio a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el tipo de sitio actualizado
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada (campos opcionales para actualización)
        $request->validate([
            'nombre_tipo_sitio' => 'sometimes|string|max:255',
            'estado' => 'sometimes|boolean',
            'fecha_creacion' => 'sometimes|date',
            'fecha_modificacion' => 'sometimes|date',
        ]);

        // Buscar y actualizar el tipo de sitio
        $tipoSitio = TipoSitio::findOrFail($id);
        $tipoSitio->update($request->all());
        return response()->json($tipoSitio);
    }

    /**
     * Eliminar un tipo de sitio
     * 
     * @param int $id ID del tipo de sitio a eliminar
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta vacía con código de estado 204
     */
    public function destroy($id)
    {
        $tipoSitio = TipoSitio::findOrFail($id);
        $tipoSitio->delete();
        return response()->json(null, 204);
    }
}
