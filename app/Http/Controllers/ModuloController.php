<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use Illuminate\Http\Request;

/**
 * Controlador para gestionar los módulos del sistema
 * 
 * Este controlador maneja todas las operaciones CRUD relacionadas con los módulos,
 * incluyendo la creación, lectura, actualización y eliminación de registros de módulos.
 * Los módulos representan secciones funcionales del sistema con rutas específicas.
 */
class ModuloController extends Controller
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
     * Obtener todos los módulos
     * 
     * @return \Illuminate\Http\JsonResponse
     * Retorna una lista JSON con todos los módulos registrados
     */
    public function index()
    {
        return response()->json(Modulo::all());
    }

    /**
     * Crear un nuevo módulo
     * 
     * @param Request $request Datos del módulo a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna el módulo creado con código de estado 201
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'rutas' => 'required|string|max:255',
            'descripcion_ruta' => 'required|string|max:255',
            'mensaje_cambio' => 'required|string|max:255',
            'imagen' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'es_submenu' => 'required|boolean',
            'modulo_padre_id' => 'nullable|exists:modulos,id_modulo',
            'fecha_creacion' => 'nullable|date',
            'fecha_accion' => 'nullable|date',
        ]);

        // Crear el nuevo módulo
        $modulo = Modulo::create($request->all());
        return response()->json($modulo, 201);
    }

    /**
     * Obtener un módulo específico por ID
     * 
     * @param int $id ID del módulo a buscar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el módulo encontrado o error 404 si no existe
     */
    public function show($id)
    {
        $modulo = Modulo::findOrFail($id);
        return response()->json($modulo);
    }

    /**
     * Actualizar un módulo existente
     * 
     * @param Request $request Datos actualizados del módulo
     * @param int $id ID del módulo a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el módulo actualizado
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada (campos opcionales para actualización)
        $request->validate([
            'rutas' => 'sometimes|string|max:255',
            'descripcion_ruta' => 'sometimes|string|max:255',
            'mensaje_cambio' => 'sometimes|string|max:255',
            'imagen' => 'sometimes|string|max:255',
            'estado' => 'sometimes|boolean',
            'es_submenu' => 'sometimes|boolean',
            'modulo_padre_id' => 'nullable|exists:modulos,id_modulo',
            'fecha_creacion' => 'nullable|date',
            'fecha_accion' => 'nullable|date',
        ]);

        // Buscar y actualizar el módulo
        $modulo = Modulo::findOrFail($id);
        $modulo->update($request->all());
        return response()->json($modulo);
    }

    /**
     * Eliminar un módulo
     * 
     * @param int $id ID del módulo a eliminar
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta vacía con código de estado 204
     */
    public function destroy($id)
    {
        $modulo = Modulo::findOrFail($id);
        $modulo->delete();
        return response()->json(null, 204);
    }
}
