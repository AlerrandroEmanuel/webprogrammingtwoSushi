<?php
require "./src/funcionarioTypes.php";

use funcionarios\funcionario;
use funcionariosType\funcionarioCLT;
use funcionariosType\funcionarioFreeLancer;
use funcionariosType\prestador;

$workers = [];

$workers[] = new funcionario("jonas", 32.5, 56);
$workers[] = new funcionarioclt("maria", 1780, 42);
$workers[] = new funcionarioFreeLancer("pedrin", 2800, 52, 37.98);
$workers[] = new prestador("sophya", 2500, 56);

foreach ($workers as $funcio) {
    echo "<br>Salario do funcionario " .
        $funcio->name . " eh : R$" .
        $funcio->calcRemuneracao() . "<br>";
}

// para criar um novo tipo de funcionário é necessário criar uma nova clase no 
// arquivo funcionáriosType que extende a classe funcionario e esse novo tipo pode
// implementar sua própria regra para calcRemuneracao();
// No código main é preciso criar um novo índice que implementa um objeto do novo tipo
// funcionário criado