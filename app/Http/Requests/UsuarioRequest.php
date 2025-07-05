<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'edad' => 'required|integer',
            'cedula' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:usuarios,email',
            'password' => 'required|string|min:6',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'fecha_registro' => 'required|date',
            'rol_id' => 'required|exists:roles,id_rol',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
            'nombre.max' => 'El campo nombre no puede tener más de 255 caracteres.',
            
            'apellido.required' => 'El campo apellido es obligatorio.',
            'apellido.string' => 'El campo apellido debe ser una cadena de texto.',
            'apellido.max' => 'El campo apellido no puede tener más de 255 caracteres.',
            
            'edad.required' => 'El campo edad es obligatorio.',
            'edad.integer' => 'El campo edad debe ser un número entero.',
            
            'cedula.required' => 'El campo cédula es obligatorio.',
            'cedula.string' => 'El campo cédula debe ser una cadena de texto.',
            'cedula.max' => 'El campo cédula no puede tener más de 20 caracteres.',
            
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser una dirección de correo válida.',
            'email.max' => 'El campo email no puede tener más de 255 caracteres.',
            'email.unique' => 'Este email ya está registrado.',
            
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.string' => 'El campo contraseña debe ser una cadena de texto.',
            'password.min' => 'El campo contraseña debe tener al menos 6 caracteres.',
            
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'telefono.string' => 'El campo teléfono debe ser una cadena de texto.',
            'telefono.max' => 'El campo teléfono no puede tener más de 20 caracteres.',
            
            'direccion.required' => 'El campo dirección es obligatorio.',
            'direccion.string' => 'El campo dirección debe ser una cadena de texto.',
            'direccion.max' => 'El campo dirección no puede tener más de 255 caracteres.',
            
            'fecha_registro.required' => 'El campo fecha de registro es obligatorio.',
            'fecha_registro.date' => 'El campo fecha de registro debe ser una fecha válida.',
            
            'rol_id.required' => 'El campo rol es obligatorio.',
            'rol_id.exists' => 'El rol seleccionado no existe.',
        ];
    }
} 