<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Http\Requests\RolRequest;
use Illuminate\Http\Request;

/**
 * Controlador para gestionar los roles del sistema
 * 
 * Este controlador maneja todas las operaciones CRUD relacionadas con los roles,
 * incluyendo la creación, lectura, actualización y eliminación de registros de roles.
 * Los roles definen los niveles de acceso y permisos de los usuarios en el sistema.
 */
class RolController extends Controller
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
     * Obtener todos los roles
     * 
     * @return \Illuminate\Http\JsonResponse
     * Retorna una lista JSON con todos los roles registrados
     */
    public function index()
    {
        return response()->json(Rol::all());
    }

    /**
     * Crear un nuevo rol
     * 
     * @param RolRequest $request Datos validados del rol a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna el rol creado con código de estado 201
     */
    public function store(RolRequest $request)
    {
        // Crear el nuevo rol con datos validados
        $rol = Rol::create($request->validated());
        return response()->json($rol, 201);
    }

    /**
     * Obtener un rol específico por ID
     * 
     * @param int $id ID del rol a buscar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el rol encontrado o error 404 si no existe
     */
    public function show($id)
    {
        $rol = Rol::findOrFail($id);
        return response()->json($rol);
    }

    /**
     * Actualizar un rol existente
     * 
     * @param RolRequest $request Datos validados del rol a actualizar
     * @param int $id ID del rol a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el rol actualizado
     */
    public function update(RolRequest $request, $id)
    {
        // Buscar y actualizar el rol con datos validados
        $rol = Rol::findOrFail($id);
        $rol->update($request->validated());
        return response()->json($rol);
    }

    /**
     * Eliminar un rol
     * 
     * @param int $id ID del rol a eliminar
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta vacía con código de estado 204
     */
    public function destroy($id)
    {
        $rol = Rol::findOrFail($id);
        $rol->delete();
        return response()->json(null, 204);
    }
} 