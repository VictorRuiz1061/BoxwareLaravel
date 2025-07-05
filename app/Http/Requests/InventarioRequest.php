<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventarioRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'stock' => 'required|integer',
            'placa_sena' => 'required|string',
            'descripcion' => 'required|string',
            'sitio_id' => 'required|exists:sitios,id_sitio',
        ];
    }

    public function messages()
    {
        return [
            'stock.required' => 'El campo stock es obligatorio.',
            'stock.integer' => 'El campo stock debe ser un número entero.',
            
            'placa_sena.required' => 'El campo placa SENA es obligatorio.',
            'placa_sena.string' => 'El campo placa SENA debe ser una cadena de texto.',
            
            'descripcion.required' => 'El campo descripción es obligatorio.',
            'descripcion.string' => 'El campo descripción debe ser una cadena de texto.',
            
            'sitio_id.required' => 'El campo sitio es obligatorio.',
            'sitio_id.exists' => 'El sitio seleccionado no existe.',
        ];
    }
} 