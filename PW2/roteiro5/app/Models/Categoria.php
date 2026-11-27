
<?php

class Categoria extends \Illuminate\Database\Eloquent\Model
{
    protected $fillable = [
        'nome'
    ];

    public function produtos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Produto::class);
    }
}
