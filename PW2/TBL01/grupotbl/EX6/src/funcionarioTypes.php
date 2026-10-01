<?php

namespace funcionariosType;

require "funcionario.php";

use funcionarios\funcionario;
use Override;

class funcionarioCLT extends funcionario
{
    public function calcRemuneracao()
    {
        return $this->salario -= $this->salario * 0.20;
    }
}

class funcionarioFreeLancer extends funcionario
{
    public function __construct($name, $salario, $horas, $salario_horas)
    {
        $this->name = $name;
        $this->salario = $salario;
        $this->horas = $horas;
        $this->salario_hora = $salario_horas;
    }
    public function calcRemuneracao()
    {
        $sal = $this->salario_hora * $this->horas;
        if ($sal > $this->salario) {
            return $sal;
        } else {
            return $this->salario;
        }
    }
}

class prestador extends funcionario
{
    public function calcRemuneracao()
    {
        return $this->salario;
    }
}