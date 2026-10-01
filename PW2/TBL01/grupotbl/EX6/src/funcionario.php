<?php

namespace funcionarios;

require "funcionarioInterface.php";

class funcionario implements Ifuncionario
{
    public $name;
    protected $salario;
    protected $horas;
    protected $salario_hora;

    public function __construct(
        $name,
        $salaraio,
        $horas
    ) {
        $this->name = $name;
        $this->salario = $salaraio;
        $this->horas = $horas;
    }

    public function calcRemuneracao()
    {
        return $this->salario * $this->horas;
    }
}