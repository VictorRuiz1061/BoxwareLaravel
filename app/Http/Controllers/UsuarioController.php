<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Requests\UsuarioRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Controlador para gestionar los usuarios del sistema
 * 
 * Este controlador maneja todas las operaciones CRUD relacionadas con los usuarios,
 * incluyendo la creación, lectura, actualización y eliminación de cuentas de usuario.
 * También maneja el hash de contraseñas para seguridad.
 */
class UsuarioController extends Controller
{
    /**
     * Obtener todos los usuarios
     * 
     * @return \Illuminate\Http\JsonResponse
     * Retorna una lista JSON con todos los usuarios registrados
     */
    public function index()
    {
        return response()->json(Usuario::all());
    }

    /**
     * Crear un nuevo usuario
     * 
     * @param UsuarioRequest $request Datos validados del usuario a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna el usuario creado con código de estado 201
     */
    public function store(UsuarioRequest $request)
    {
        // Obtener datos validados y hashear la contraseña
        $datos = $request->validated();
        $datos['password'] = Hash::make($datos['password']);
        
        // Crear el nuevo usuario
        $usuario = Usuario::create($datos);
        return response()->json($usuario, 201);
    }

    /**
     * Obtener un usuario específico por ID
     * 
     * @param int $id ID del usuario a buscar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el usuario encontrado o error 404 si no existe
     */
    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        return response()->json($usuario);
    }

    /**
     * Actualizar un usuario existente
     * 
     * @param UsuarioRequest $request Datos validados del usuario a actualizar
     * @param int $id ID del usuario a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el usuario actualizado
     */
    public function update(UsuarioRequest $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->validated());
        return response()->json($usuario);
    }

    /**
     * Eliminar un usuario
     * 
     * @param int $id ID del usuario a eliminar
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta vacía con código de estado 204
     */
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return response()->json(null, 204);
    }
} 