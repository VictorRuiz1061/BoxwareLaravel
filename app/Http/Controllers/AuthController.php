<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * Controlador para gestionar la autenticación de usuarios
 * 
 * Este controlador maneja el proceso de login, registro y logout de usuarios,
 * incluyendo la validación de credenciales y la gestión de sesiones.
 * Utiliza el sistema de autenticación nativo de Laravel.
 */
class AuthController extends Controller
{
    /**
     * Constructor del controlador
     * Aplica middleware de autenticación solo a rutas específicas
     */
    public function __construct()
    {
        $this->middleware('auth')->only('logout');
    }

    /**
     * Mostrar el formulario de login
     * 
     * @return \Illuminate\View\View
     * Retorna la vista del formulario de login
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Procesar el intento de login
     * 
     * @param Request $request Datos del formulario de login
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta JSON con el resultado del login y token de acceso
     */
    public function login(Request $request)
    {
        try {
            // Validar los datos de entrada
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            // Intentar autenticar al usuario
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials, $request->filled('remember'))) {
                // Login exitoso
                $user = Auth::user();
                
                // Generar token de acceso usando Sanctum
                $token = $user->createToken('api-token')->plainTextToken;
                
                return response()->json([
                    'success' => true,
                    'message' => 'Login exitoso',
                    'token' => $token,
                    'token_type' => 'Bearer',
                    'user' => [
                        'id' => $user->id_usuario,
                        'email' => $user->email,
                        'rol' => $user->rol,
                    ]
                ]);
            }

            // Login fallido
            return response()->json([
                'success' => false,
                'message' => 'Credenciales inválidas'
            ], 401);
        } catch (\Throwable $e) {
            // Loguea el error para verlo en el log
            \Log::error('Error en login: '.$e->getMessage(), ['exception' => $e]);
            return response()->json([
                'success' => false,
                'message' => 'Error interno del servidor',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Registrar un nuevo usuario
     * 
     * @param Request $request Datos del nuevo usuario
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta JSON con el resultado del registro
     */
    public function register(Request $request)
    {
        try {
            // Validar los datos de entrada con mensajes personalizados
            $request->validate([
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'email' => 'required|email|unique:usuarios,email',
                'password' => 'required|string|min:6|confirmed',
                'estado' => 'boolean',
                'rol_id' => 'exists:roles,id_rol',
            ], [
                'nombre.required' => 'El campo nombre es obligatorio.',
                'apellido.required' => 'El campo apellido es obligatorio.',
                'email.required' => 'El campo email es obligatorio.',
                'email.email' => 'El email debe ser una dirección válida.',
                'email.unique' => 'Este email ya está registrado.',
                'password.required' => 'El campo contraseña es obligatorio.',
                'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
                'password.confirmed' => 'Las contraseñas no coinciden.',
            ]);

            // Crear el nuevo usuario con contraseña hasheada
            $usuario = Usuario::create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'estado' => $request->estado ?? true,
                'rol_id' => $request->rol_id ?? 3, // Rol por defecto: 3
                'fecha_registro' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Usuario registrado exitosamente',
                'user' => $usuario
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error interno del servidor',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cerrar sesión del usuario
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta JSON confirmando el logout
     */
    public function logout(Request $request)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
        
        // Revocar el token actual del usuario si existe
        if ($user && $user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
        }
        
        // Cerrar sesión y invalidar tokens de sesión
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'success' => true,
            'message' => 'Logout exitoso'
        ]);
    }

    /**
     * Obtener información del usuario autenticado
     * 
     * @return \Illuminate\Http\JsonResponse
     * Retorna información del usuario actual
     */
    public function user()
    {
        return response()->json(Auth::user());
    }

    /**
     * Revocar todos los tokens del usuario
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta JSON confirmando la revocación de tokens
     */
    public function revokeAllTokens(Request $request)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
        
        // Revocar todos los tokens del usuario
        $user->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Todos los tokens han sido revocados exitosamente'
        ]);
    }
}
