<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SitioRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre_sitio' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'ficha_tecnica' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'tipo_sitio_id' => 'required|exists:tipos_sitio,id_tipo_sitio',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'nombre_sitio.required' => 'El campo nombre del sitio es obligatorio.',
            'nombre_sitio.string' => 'El campo nombre del sitio debe ser una cadena de texto.',
            'nombre_sitio.max' => 'El campo nombre del sitio no puede tener más de 255 caracteres.',
            
            'ubicacion.required' => 'El campo ubicación es obligatorio.',
            'ubicacion.string' => 'El campo ubicación debe ser una cadena de texto.',
            'ubicacion.max' => 'El campo ubicación no puede tener más de 255 caracteres.',
            
            'ficha_tecnica.required' => 'El campo ficha técnica es obligatorio.',
            'ficha_tecnica.string' => 'El campo ficha técnica debe ser una cadena de texto.',
            'ficha_tecnica.max' => 'El campo ficha técnica no puede tener más de 255 caracteres.',
            
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.boolean' => 'El campo estado debe ser verdadero o falso.',
            
            'tipo_sitio_id.required' => 'El campo tipo de sitio es obligatorio.',
            'tipo_sitio_id.exists' => 'El tipo de sitio seleccionado no existe.',
            
            'fecha_creacion.required' => 'El campo fecha de creación es obligatorio.',
            'fecha_creacion.date' => 'El campo fecha de creación debe ser una fecha válida.',
            
            'fecha_modificacion.required' => 'El campo fecha de modificación es obligatorio.',
            'fecha_modificacion.date' => 'El campo fecha de modificación debe ser una fecha válida.',
        ];
    }
} 