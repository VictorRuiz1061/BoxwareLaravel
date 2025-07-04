<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre_rol' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'estado' => 'required|string|max:50',
            'fecha_creacion' => 'required|date',
            'fecha_modificacion' => 'required|date',
        ];
    }
} 