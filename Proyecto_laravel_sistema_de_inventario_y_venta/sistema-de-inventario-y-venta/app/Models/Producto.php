<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;


    protected $fillable = [
        'nombre',
        'descripcion',
        'marca',
        'medida',
        'precio',
        'stock',
        'user_id'
    ];

    // Relación: Un producto pertenece a un usuario 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
