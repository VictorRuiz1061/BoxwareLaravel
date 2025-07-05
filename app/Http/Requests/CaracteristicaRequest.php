<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CaracteristicaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre_caracteristica' => 'required|string|max:255',
            'descripcion_caracteristica' => 'required|string',
            'estado' => 'required|boolean',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'nombre_caracteristica.required' => 'El campo nombre de la característica es obligatorio.',
            'nombre_caracteristica.string' => 'El campo nombre de la característica debe ser una cadena de texto.',
            'nombre_caracteristica.max' => 'El campo nombre de la característica no puede tener más de 255 caracteres.',
            
            'descripcion_caracteristica.required' => 'El campo descripción de la característica es obligatorio.',
            'descripcion_caracteristica.string' => 'El campo descripción de la característica debe ser una cadena de texto.',
            
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.boolean' => 'El campo estado debe ser verdadero o falso.',
            
            'fecha_creacion.required' => 'El campo fecha de creación es obligatorio.',
            'fecha_creacion.date' => 'El campo fecha de creación debe ser una fecha válida.',
            
            'fecha_modificacion.required' => 'El campo fecha de modificación es obligatorio.',
            'fecha_modificacion.date' => 'El campo fecha de modificación debe ser una fecha válida.',
        ];
    }
} 