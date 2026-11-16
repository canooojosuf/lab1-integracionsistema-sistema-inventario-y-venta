<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // <-- CAMBIA ESTO A TRUE
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Copia las mismas reglas que tienes en StoreProductoRequest
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
