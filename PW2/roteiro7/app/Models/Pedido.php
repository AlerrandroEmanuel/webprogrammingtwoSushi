
<?php

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'cliente_id',
        'data_pedido',
        'status',
        'valor_total'
    ];

    protected $casts = [
        'data_pedido' => 'date',
        'valor_total' => 'decimal:2'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
