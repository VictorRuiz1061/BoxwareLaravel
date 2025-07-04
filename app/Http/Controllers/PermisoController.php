<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
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
     * @param Request $request Datos del permiso a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna el permiso creado con código de estado 201
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'puede_ver' => 'required|boolean',
            'puede_crear' => 'required|boolean',
            'puede_editar' => 'required|boolean',
            'puede_eliminar' => 'required|boolean',
            'modulo_id' => 'required|exists:modulos,id_modulo',
            'rol_id' => 'required|exists:roles,id_rol',
            'fecha_creacion' => 'required|date',
        ]);

        // Crear el nuevo permiso
        $permiso = Permiso::create($request->all());
        return response()->json($permiso, 201);
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
     * @param Request $request Datos actualizados del permiso
     * @param int $id ID del permiso a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el permiso actualizado
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada (campos opcionales para actualización)
        $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'estado' => 'sometimes|boolean',
            'puede_ver' => 'sometimes|boolean',
            'puede_crear' => 'sometimes|boolean',
            'puede_editar' => 'sometimes|boolean',
            'puede_eliminar' => 'sometimes|boolean',
            'modulo_id' => 'sometimes|exists:modulos,id_modulo',
            'rol_id' => 'sometimes|exists:roles,id_rol',
            'fecha_creacion' => 'sometimes|date',
        ]);

        // Buscar y actualizar el permiso
        $permiso = Permiso::findOrFail($id);
        $permiso->update($request->all());
        return response()->json($permiso);
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
