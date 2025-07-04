<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Http\Request;

/**
 * Controlador para gestionar los programas de formación
 * 
 * Este controlador maneja todas las operaciones CRUD relacionadas con los programas,
 * incluyendo la creación, lectura, actualización y eliminación de registros de programas.
 * Los programas representan ofertas educativas específicas del SENA.
 */
class ProgramaController extends Controller
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
     * Obtener todos los programas
     * 
     * @return \Illuminate\Http\JsonResponse
     * Retorna una lista JSON con todos los programas registrados
     */
    public function index()
    {
        return response()->json(Programa::all());
    }

    /**
     * Crear un nuevo programa
     * 
     * @param Request $request Datos del programa a crear
     * @return \Illuminate\Http\JsonResponse
     * Retorna el programa creado con código de estado 201
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nombre_programa' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'area_id' => 'required|exists:areas,id_area',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
        ]);

        // Crear el nuevo programa
        $programa = Programa::create($request->all());
        return response()->json($programa, 201);
    }

    /**
     * Obtener un programa específico por ID
     * 
     * @param int $id ID del programa a buscar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el programa encontrado o error 404 si no existe
     */
    public function show($id)
    {
        $programa = Programa::findOrFail($id);
        return response()->json($programa);
    }

    /**
     * Actualizar un programa existente
     * 
     * @param Request $request Datos actualizados del programa
     * @param int $id ID del programa a actualizar
     * @return \Illuminate\Http\JsonResponse
     * Retorna el programa actualizado
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada (campos opcionales para actualización)
        $request->validate([
            'nombre_programa' => 'sometimes|string|max:255',
            'estado' => 'sometimes|boolean',
            'area_id' => 'sometimes|exists:areas,id_area',
            'fecha_creacion' => 'sometimes|date',
            'fecha_modificacion' => 'sometimes|date',
        ]);

        // Buscar y actualizar el programa
        $programa = Programa::findOrFail($id);
        $programa->update($request->all());
        return response()->json($programa);
    }

    /**
     * Eliminar un programa
     * 
     * @param int $id ID del programa a eliminar
     * @return \Illuminate\Http\JsonResponse
     * Retorna respuesta vacía con código de estado 204
     */
    public function destroy($id)
    {
        $programa = Programa::findOrFail($id);
        $programa->delete();
        return response()->json(null, 204);
    }
}
