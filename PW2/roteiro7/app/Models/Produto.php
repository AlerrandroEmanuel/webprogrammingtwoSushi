
<?php

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'categoria',
        'preco',
        'situacao'
    ];
}
