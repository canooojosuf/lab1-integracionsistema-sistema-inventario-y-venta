<?php

namespace App\Models;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaccion extends Model
{

    use HasFactory;

protected $table = 'transacciones';

    protected $fillable = [
        'producto_id',
        'cantidad',
        'monto',
        'moneda',
        'cliente_nombre',
        'metodo_pago',
        'estado',
    ];

      protected function casts(): array
    {
        return [
            'cantidad' => 'integer',
            'monto' => 'decimal:2',
        ];
    }
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}