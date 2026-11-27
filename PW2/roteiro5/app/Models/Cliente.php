
<?php

class Cliente extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = [
        'nome',
        'email'
    ];

    public function pedidos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Pedido::class);
    }
}
