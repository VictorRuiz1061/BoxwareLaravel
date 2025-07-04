<?php

namespace App\Http\Controllers;

use App\Models\Ficha;
use Illuminate\Http\Request;

/**
 * Controlador para gestionar las fichas de formación
 * 
 * Este controlador maneja todas las operaciones CRUD relacionadas con las fichas,
 * incluyendo la creación, lectura, actualización y eliminación de registros de fichas.
 * Las fichas representan programas de formación específicos asignados a usuarios.
 */
class FichaController extends Controller
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
     * Obtener todas las fichas
     * 
     * @return \Illuminate\Http\JsonResponse
     * Retorna una lista JSON con todas las fichas registradas
     */
    public function index()
    {
        return response()->json(Ficha::all());
    }

    /**
     * Crear una nueva ficha
     * 
     * @param Request $request Datos de la ficha a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna la ficha creada con código de estado 201
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'estado' => 'required|boolean',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
            'usuario_id' => 'required|exists:usuarios,id_usuario',
            'programa_id' => 'required|exists:programas,id_programa',
        ]);

        // Crear la nueva ficha
        $ficha = Ficha::create($request->all());
        return response()->json($ficha, 201);
    }

    /**
     * Obtener una ficha específica por ID
     * 
     * @param int $id ID de la ficha a buscar
     * @return \Illuminate\Http\JsonResponse
     * Retorna la ficha encontrada o error 404 si no existe
     */
    public function show($id)
    {
        $ficha = Ficha::findOrFail($id);
        return response()->json($ficha);
    }

    /**
     * Actualizar una ficha existente
     * 
     * @param Request $request Datos actualizados de la ficha
     * @param int $id ID de la ficha a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna la ficha actualizada
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada (campos opcionales para actualización)
        $request->validate([
            'estado' => 'sometimes|boolean',
            'fecha_creacion' => 'sometimes|date',
            'fecha_modificacion' => 'sometimes|date',
            'usuario_id' => 'sometimes|exists:usuarios,id_usuario',
            'programa_id' => 'sometimes|exists:programas,id_programa',
        ]);

        // Buscar y actualizar la ficha
        $ficha = Ficha::findOrFail($id);
        $ficha->update($request->all());
        return response()->json($ficha);
    }

    /**
     * Eliminar una ficha
     * 
     * @param int $id ID de la ficha a eliminar
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta vacía con código de estado 204
     */
    public function destroy($id)
    {
        $ficha = Ficha::findOrFail($id);
        $ficha->delete();
        return response()->json(null, 204);
    }
}
