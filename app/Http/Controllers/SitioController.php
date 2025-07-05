<?php

namespace App\Http\Controllers;

use App\Models\Sitio;
use App\Http\Requests\SitioRequest;
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
     * @param SitioRequest $request Datos validados del sitio a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna el sitio creado con código de estado 201
     */
    public function store(SitioRequest $request)
    {
        try {
            $sitio = Sitio::create($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Sitio creado exitosamente',
                'data' => $sitio
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el sitio',
                'error' => $e->getMessage()
            ], 500);
        }
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
     * @param SitioRequest $request Datos validados del sitio a actualizar
     * @param int $id ID del sitio a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el sitio actualizado
     */
    public function update(SitioRequest $request, $id)
    {
        try {
            $sitio = Sitio::findOrFail($id);
            $sitio->update($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Sitio actualizado exitosamente',
                'data' => $sitio
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el sitio',
                'error' => $e->getMessage()
            ], 500);
        }
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
