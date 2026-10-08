<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // aqui lo cambiamos de false a true para que nos deje guardar
    }

    public function rules(): array
    {
        return [
            'nombre'      => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'marca'       => 'nullable|string|max:50',
            'medida'      => 'required|string|max:150',
            'precio'      => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
        ];
    }
}
