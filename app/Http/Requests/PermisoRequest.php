<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermisoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'puede_ver' => 'required|boolean',
            'puede_crear' => 'required|boolean',
            'puede_editar' => 'required|boolean',
            'puede_eliminar' => 'required|boolean',
            'modulo_id' => 'required|exists:modulos,id_modulo',
            'rol_id' => 'required|exists:roles,id_rol',
            'fecha_creacion' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
            'nombre.max' => 'El campo nombre no puede tener más de 255 caracteres.',
            
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.boolean' => 'El campo estado debe ser verdadero o falso.',
            
            'puede_ver.required' => 'El campo puede ver es obligatorio.',
            'puede_ver.boolean' => 'El campo puede ver debe ser verdadero o falso.',
            
            'puede_crear.required' => 'El campo puede crear es obligatorio.',
            'puede_crear.boolean' => 'El campo puede crear debe ser verdadero o falso.',
            
            'puede_editar.required' => 'El campo puede editar es obligatorio.',
            'puede_editar.boolean' => 'El campo puede editar debe ser verdadero o falso.',
            
            'puede_eliminar.required' => 'El campo puede eliminar es obligatorio.',
            'puede_eliminar.boolean' => 'El campo puede eliminar debe ser verdadero o falso.',
            
            'modulo_id.required' => 'El campo módulo es obligatorio.',
            'modulo_id.exists' => 'El módulo seleccionado no existe.',
            
            'rol_id.required' => 'El campo rol es obligatorio.',
            'rol_id.exists' => 'El rol seleccionado no existe.',
            
            'fecha_creacion.required' => 'El campo fecha de creación es obligatorio.',
            'fecha_creacion.date' => 'El campo fecha de creación debe ser una fecha válida.',
        ];
    }
} 