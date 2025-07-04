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
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'fecha_registro' => 'required|date',
            'rol_id' => 'required|exists:roles,id_rol',
            'password' => 'required|string|min:6',
        ];
    }
} 