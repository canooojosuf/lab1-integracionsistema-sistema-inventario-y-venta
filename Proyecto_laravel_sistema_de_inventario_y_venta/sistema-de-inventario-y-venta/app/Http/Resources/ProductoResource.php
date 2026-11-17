<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'marca' => $this->marca,
            'medida' => $this->medida,
            'precio' => (float) $this->precio, 
            'stock' => (int) $this->stock,
            
        ];
    }
}