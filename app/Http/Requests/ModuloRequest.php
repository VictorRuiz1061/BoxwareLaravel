<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuloRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'rutas' => 'required|string|max:255',
            'descripcion_ruta' => 'required|string|max:255',
            'mensaje_cambio' => 'required|string|max:255',
            'imagen' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'es_submenu' => 'required|boolean',
            'modulo_padre_id' => 'nullable|exists:modulos,id_modulo',
            'fecha_creacion' => 'nullable|date',
            'fecha_accion' => 'nullable|date',
        ];
    }

    public function messages()
    {
        return [
            'rutas.required' => 'El campo rutas es obligatorio.',
            'rutas.string' => 'El campo rutas debe ser una cadena de texto.',
            'rutas.max' => 'El campo rutas no puede tener más de 255 caracteres.',
            
            'descripcion_ruta.required' => 'El campo descripción de la ruta es obligatorio.',
            'descripcion_ruta.string' => 'El campo descripción de la ruta debe ser una cadena de texto.',
            'descripcion_ruta.max' => 'El campo descripción de la ruta no puede tener más de 255 caracteres.',
            
            'mensaje_cambio.required' => 'El campo mensaje de cambio es obligatorio.',
            'mensaje_cambio.string' => 'El campo mensaje de cambio debe ser una cadena de texto.',
            'mensaje_cambio.max' => 'El campo mensaje de cambio no puede tener más de 255 caracteres.',
            
            'imagen.required' => 'El campo imagen es obligatorio.',
            'imagen.string' => 'El campo imagen debe ser una cadena de texto.',
            'imagen.max' => 'El campo imagen no puede tener más de 255 caracteres.',
            
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.boolean' => 'El campo estado debe ser verdadero o falso.',
            
            'es_submenu.required' => 'El campo es submenu es obligatorio.',
            'es_submenu.boolean' => 'El campo es submenu debe ser verdadero o falso.',
            
            'modulo_padre_id.exists' => 'El módulo padre seleccionado no existe.',
            
            'fecha_creacion.date' => 'El campo fecha de creación debe ser una fecha válida.',
            'fecha_accion.date' => 'El campo fecha de acción debe ser una fecha válida.',
        ];
    }
} 