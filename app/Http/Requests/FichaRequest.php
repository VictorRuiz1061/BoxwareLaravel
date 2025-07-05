<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FichaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'estado' => 'required|boolean',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
            'usuario_id' => 'required|exists:usuarios,id_usuario',
            'programa_id' => 'required|exists:programas,id_programa',
        ];
    }

    public function messages()
    {
        return [
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.boolean' => 'El campo estado debe ser verdadero o falso.',
            
            'fecha_creacion.required' => 'El campo fecha de creación es obligatorio.',
            'fecha_creacion.date' => 'El campo fecha de creación debe ser una fecha válida.',
            
            'fecha_modificacion.required' => 'El campo fecha de modificación es obligatorio.',
            'fecha_modificacion.date' => 'El campo fecha de modificación debe ser una fecha válida.',
            
            'usuario_id.required' => 'El campo usuario es obligatorio.',
            'usuario_id.exists' => 'El usuario seleccionado no existe.',
            
            'programa_id.required' => 'El campo programa es obligatorio.',
            'programa_id.exists' => 'El programa seleccionado no existe.',
        ];
    }
} 