<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SedeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre_sede' => 'required|string|max:255',
            'direccion_sede' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'centro_id' => 'required|exists:centros,id_centro',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'nombre_sede.required' => 'El campo nombre de la sede es obligatorio.',
            'nombre_sede.string' => 'El campo nombre de la sede debe ser una cadena de texto.',
            'nombre_sede.max' => 'El campo nombre de la sede no puede tener más de 255 caracteres.',
            
            'direccion_sede.required' => 'El campo dirección de la sede es obligatorio.',
            'direccion_sede.string' => 'El campo dirección de la sede debe ser una cadena de texto.',
            'direccion_sede.max' => 'El campo dirección de la sede no puede tener más de 255 caracteres.',
            
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.boolean' => 'El campo estado debe ser verdadero o falso.',
            
            'centro_id.required' => 'El campo centro es obligatorio.',
            'centro_id.exists' => 'El centro seleccionado no existe.',
            
            'fecha_creacion.required' => 'El campo fecha de creación es obligatorio.',
            'fecha_creacion.date' => 'El campo fecha de creación debe ser una fecha válida.',
            
            'fecha_modificacion.required' => 'El campo fecha de modificación es obligatorio.',
            'fecha_modificacion.date' => 'El campo fecha de modificación debe ser una fecha válida.',
        ];
    }
} 