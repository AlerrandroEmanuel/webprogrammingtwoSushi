
<?php

class Curso extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'cursos';

    protected $fillable = [
        'nome',
        'carga_horaria'
    ];
}
