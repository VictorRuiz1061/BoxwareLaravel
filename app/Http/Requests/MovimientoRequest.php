<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovimientoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'estado' => 'required|boolean',
            'cantidad' => 'required|integer',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
            'tipo_movimiento_id' => 'required|exists:tipos_movimiento,id_tipo_movimiento',
            'material_id' => 'required|exists:materiales,id_material',
        ];
    }

    public function messages()
    {
        return [
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.boolean' => 'El campo estado debe ser verdadero o falso.',
            
            'cantidad.required' => 'El campo cantidad es obligatorio.',
            'cantidad.integer' => 'El campo cantidad debe ser un número entero.',
            
            'fecha_creacion.required' => 'El campo fecha de creación es obligatorio.',
            'fecha_creacion.date' => 'El campo fecha de creación debe ser una fecha válida.',
            
            'fecha_modificacion.required' => 'El campo fecha de modificación es obligatorio.',
            'fecha_modificacion.date' => 'El campo fecha de modificación debe ser una fecha válida.',
            
            'tipo_movimiento_id.required' => 'El campo tipo de movimiento es obligatorio.',
            'tipo_movimiento_id.exists' => 'El tipo de movimiento seleccionado no existe.',
            
            'material_id.required' => 'El campo material es obligatorio.',
            'material_id.exists' => 'El material seleccionado no existe.',
        ];
    }
} 