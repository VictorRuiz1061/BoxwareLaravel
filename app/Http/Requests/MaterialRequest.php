<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'codigo_sena' => 'required|string|max:100',
            'nombre_material' => 'required|string|max:255',
            'descripcion_material' => 'required|string',
            'unidad_medida' => 'required|string|max:100',
            'producto_peresedero' => 'required|boolean',
            'estado' => 'required|boolean',
            'fecha_vencimiento' => 'required|date',
            'imagen' => 'nullable|string',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
            'categoria_id' => 'required|exists:categorias_elementos,id_categoria_elemento',
            'tipo_material_id' => 'required|exists:tipo_materiales,id_tipo_material',
        ];
    }

    public function messages()
    {
        return [
            'codigo_sena.required' => 'El campo código SENA es obligatorio.',
            'codigo_sena.string' => 'El campo código SENA debe ser una cadena de texto.',
            'codigo_sena.max' => 'El campo código SENA no puede tener más de 100 caracteres.',
            
            'nombre_material.required' => 'El campo nombre del material es obligatorio.',
            'nombre_material.string' => 'El campo nombre del material debe ser una cadena de texto.',
            'nombre_material.max' => 'El campo nombre del material no puede tener más de 255 caracteres.',
            
            'descripcion_material.required' => 'El campo descripción del material es obligatorio.',
            'descripcion_material.string' => 'El campo descripción del material debe ser una cadena de texto.',
            
            'unidad_medida.required' => 'El campo unidad de medida es obligatorio.',
            'unidad_medida.string' => 'El campo unidad de medida debe ser una cadena de texto.',
            'unidad_medida.max' => 'El campo unidad de medida no puede tener más de 100 caracteres.',
            
            'producto_peresedero.required' => 'El campo producto perecedero es obligatorio.',
            'producto_peresedero.boolean' => 'El campo producto perecedero debe ser verdadero o falso.',
            
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.boolean' => 'El campo estado debe ser verdadero o falso.',
            
            'fecha_vencimiento.required' => 'El campo fecha de vencimiento es obligatorio.',
            'fecha_vencimiento.date' => 'El campo fecha de vencimiento debe ser una fecha válida.',
            
            'imagen.string' => 'El campo imagen debe ser una cadena de texto.',
            
            'fecha_creacion.required' => 'El campo fecha de creación es obligatorio.',
            'fecha_creacion.date' => 'El campo fecha de creación debe ser una fecha válida.',
            
            'fecha_modificacion.required' => 'El campo fecha de modificación es obligatorio.',
            'fecha_modificacion.date' => 'El campo fecha de modificación debe ser una fecha válida.',
            
            'categoria_id.required' => 'El campo categoría es obligatorio.',
            'categoria_id.exists' => 'La categoría seleccionada no existe.',
            
            'tipo_material_id.required' => 'El campo tipo de material es obligatorio.',
            'tipo_material_id.exists' => 'El tipo de material seleccionado no existe.',
        ];
    }
} 