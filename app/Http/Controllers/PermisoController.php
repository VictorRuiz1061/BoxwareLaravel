<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Http\Requests\PermisoRequest;
use Illuminate\Http\Request;

/**
 * Controlador para gestionar los permisos del sistema
 * 
 * Este controlador maneja todas las operaciones CRUD relacionadas con los permisos,
 * incluyendo la creación, lectura, actualización y eliminación de registros de permisos.
 * Los permisos controlan el acceso a diferentes módulos del sistema por rol.
 */
class PermisoController extends Controller
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
     * Obtener todos los permisos
     * 
     * @return \Illuminate\Http\JsonResponse
     * Retorna una lista JSON con todos los permisos registrados
     */
    public function index()
    {
        return response()->json(Permiso::all());
    }

    /**
     * Crear un nuevo permiso
     * 
     * @param PermisoRequest $request Datos validados del permiso a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna el permiso creado con código de estado 201
     */
    public function store(PermisoRequest $request)
    {
        try {
            $permiso = Permiso::create($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Permiso creado exitosamente',
                'data' => $permiso
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el permiso',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener un permiso específico por ID
     * 
     * @param int $id ID del permiso a buscar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el permiso encontrado o error 404 si no existe
     */
    public function show($id)
    {
        $permiso = Permiso::findOrFail($id);
        return response()->json($permiso);
    }

    /**
     * Actualizar un permiso existente
     * 
     * @param PermisoRequest $request Datos validados del permiso a actualizar
     * @param int $id ID del permiso a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el permiso actualizado
     */
    public function update(PermisoRequest $request, $id)
    {
        try {
            $permiso = Permiso::findOrFail($id);
            $permiso->update($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Permiso actualizado exitosamente',
                'data' => $permiso
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el permiso',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar un permiso
     * 
     * @param int $id ID del permiso a eliminar
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta vacía con código de estado 204
     */
    public function destroy($id)
    {
        $permiso = Permiso::findOrFail($id);
        $permiso->delete();
        return response()->json(null, 204);
    }
}
