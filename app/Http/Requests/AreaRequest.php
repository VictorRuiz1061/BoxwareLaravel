<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre_area' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
            'sede_id' => 'required|exists:sedes,id_sede',
        ];
    }

    public function messages()
    {
        return [
            'nombre_area.required' => 'El campo nombre del área es obligatorio.',
            'nombre_area.string' => 'El campo nombre del área debe ser una cadena de texto.',
            'nombre_area.max' => 'El campo nombre del área no puede tener más de 255 caracteres.',
            
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.boolean' => 'El campo estado debe ser verdadero o falso.',
            
            'fecha_creacion.required' => 'El campo fecha de creación es obligatorio.',
            'fecha_creacion.date' => 'El campo fecha de creación debe ser una fecha válida.',
            
            'fecha_modificacion.required' => 'El campo fecha de modificación es obligatorio.',
            'fecha_modificacion.date' => 'El campo fecha de modificación debe ser una fecha válida.',
            
            'sede_id.required' => 'El campo sede es obligatorio.',
            'sede_id.exists' => 'La sede seleccionada no existe.',
        ];
    }
} 