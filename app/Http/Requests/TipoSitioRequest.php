<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoSitioRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre_tipo_sitio' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'nombre_tipo_sitio.required' => 'El campo nombre del tipo de sitio es obligatorio.',
            'nombre_tipo_sitio.string' => 'El campo nombre del tipo de sitio debe ser una cadena de texto.',
            'nombre_tipo_sitio.max' => 'El campo nombre del tipo de sitio no puede tener más de 255 caracteres.',
            
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.boolean' => 'El campo estado debe ser verdadero o falso.',
            
            'fecha_creacion.required' => 'El campo fecha de creación es obligatorio.',
            'fecha_creacion.date' => 'El campo fecha de creación debe ser una fecha válida.',
            
            'fecha_modificacion.required' => 'El campo fecha de modificación es obligatorio.',
            'fecha_modificacion.date' => 'El campo fecha de modificación debe ser una fecha válida.',
        ];
    }
} 