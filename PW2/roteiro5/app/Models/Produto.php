
<?php

class Produto extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = [
        'categoria_id',
        'nome',
        'preco'
    ];

    public function categoria(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }
}
