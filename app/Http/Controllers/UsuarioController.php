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
     * Crear un nuevo usuario usando FormRequest
     * 
     * @param UsuarioRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UsuarioRequest $request)
    {
        try {
            // Los datos ya están validados por el FormRequest
            $usuario = Usuario::create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'edad' => $request->edad,
                'cedula' => $request->cedula,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'fecha_registro' => $request->fecha_registro,
                'rol_id' => $request->rol_id,
                'estado' => true,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Usuario creado exitosamente',
                'data' => $usuario
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el usuario',
                'error' => $e->getMessage()
            ], 500);
        }
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
     * Actualizar un usuario usando FormRequest
     * 
     * @param UsuarioRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UsuarioRequest $request, $id)
    {
        try {
            $usuario = Usuario::findOrFail($id);
            
            $usuario->update([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'edad' => $request->edad,
                'cedula' => $request->cedula,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'rol_id' => $request->rol_id,
            ]);

            // Solo actualizar contraseña si se proporciona
            if ($request->filled('password')) {
                $usuario->password = Hash::make($request->password);
                $usuario->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Usuario actualizado exitosamente',
                'data' => $usuario
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el usuario',
                'error' => $e->getMessage()
            ], 500);
        }
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