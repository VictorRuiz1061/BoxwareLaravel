<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaElementoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre_categoria' => 'required|string|max:255',
            'descripcion_categoria' => 'required|string',
            'estado' => 'required|boolean',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'nombre_categoria.required' => 'El campo nombre de la categoría es obligatorio.',
            'nombre_categoria.string' => 'El campo nombre de la categoría debe ser una cadena de texto.',
            'nombre_categoria.max' => 'El campo nombre de la categoría no puede tener más de 255 caracteres.',
            
            'descripcion_categoria.required' => 'El campo descripción de la categoría es obligatorio.',
            'descripcion_categoria.string' => 'El campo descripción de la categoría debe ser una cadena de texto.',
            
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.boolean' => 'El campo estado debe ser verdadero o falso.',
            
            'fecha_creacion.required' => 'El campo fecha de creación es obligatorio.',
            'fecha_creacion.date' => 'El campo fecha de creación debe ser una fecha válida.',
            
            'fecha_modificacion.required' => 'El campo fecha de modificación es obligatorio.',
            'fecha_modificacion.date' => 'El campo fecha de modificación debe ser una fecha válida.',
        ];
    }
} 