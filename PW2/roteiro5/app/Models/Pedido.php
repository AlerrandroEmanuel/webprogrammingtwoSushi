
<?php

class Pedido extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = [
        'cliente_id',
        'data',
        'valor'
    ];

    protected function casts(): array
    {
        return [
            'data' => 'date',
            'valor' => 'decimal:2'
        ];
    }

    public function cliente(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }
}
