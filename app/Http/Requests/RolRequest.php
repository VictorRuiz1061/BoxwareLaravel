<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre_rol' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'estado' => 'required|string|max:50',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'nombre_rol.required' => 'El campo nombre del rol es obligatorio.',
            'nombre_rol.string' => 'El campo nombre del rol debe ser una cadena de texto.',
            'nombre_rol.max' => 'El campo nombre del rol no puede tener más de 100 caracteres.',
            
            'descripcion.required' => 'El campo descripción es obligatorio.',
            'descripcion.string' => 'El campo descripción debe ser una cadena de texto.',
            
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.string' => 'El campo estado debe ser una cadena de texto.',
            'estado.max' => 'El campo estado no puede tener más de 50 caracteres.',
            
            'fecha_creacion.required' => 'El campo fecha de creación es obligatorio.',
            'fecha_creacion.date' => 'El campo fecha de creación debe ser una fecha válida.',
            
            'fecha_modificacion.required' => 'El campo fecha de modificación es obligatorio.',
            'fecha_modificacion.date' => 'El campo fecha de modificación debe ser una fecha válida.',
        ];
    }
} 