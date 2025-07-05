<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CentroRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre_centro' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
            'municipio_id' => 'required|exists:municipios,id_municipio',
        ];
    }

    public function messages()
    {
        return [
            'nombre_centro.required' => 'El campo nombre del centro es obligatorio.',
            'nombre_centro.string' => 'El campo nombre del centro debe ser una cadena de texto.',
            'nombre_centro.max' => 'El campo nombre del centro no puede tener más de 255 caracteres.',
            
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.boolean' => 'El campo estado debe ser verdadero o falso.',
            
            'fecha_creacion.required' => 'El campo fecha de creación es obligatorio.',
            'fecha_creacion.date' => 'El campo fecha de creación debe ser una fecha válida.',
            
            'fecha_modificacion.required' => 'El campo fecha de modificación es obligatorio.',
            'fecha_modificacion.date' => 'El campo fecha de modificación debe ser una fecha válida.',
            
            'municipio_id.required' => 'El campo municipio es obligatorio.',
            'municipio_id.exists' => 'El municipio seleccionado no existe.',
        ];
    }
} 