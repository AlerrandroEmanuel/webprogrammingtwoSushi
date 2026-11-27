
<?php

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'cursos';

    protected $fillable = [
        'nome',
        'descricao',
        'carga_horaria',
        'ativo',
    ];

    protected $casts = [
        'carga_horaria' => 'integer',
        'ativo' => 'boolean',
    ];
}
