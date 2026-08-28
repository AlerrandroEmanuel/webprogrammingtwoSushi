<?php

class ContaBancaria
{
    private $saldo;

    public function __construct($saldoInicial)
    {
        if ($saldoInicial >= 0) {
            $this->saldo = $saldoInicial;
        } else {
            $this->saldo = 0;
        }
    }

    public function depositar($valor)
    {
        if ($valor > 0) {
            $this->saldo = $this->saldo + $valor;
        }
    }

    public function sacar($valor)
    {
        if ($valor <= 0) {
            return false;
        }

        if ($valor > $this->saldo) {
            return false;
        }

        $this->saldo = $this->saldo - $valor;

        return true;
    }

    public function getSaldo()
    {
        return $this->saldo;
    }
}


$conta1 = new ContaBancaria(1000);
$conta2 = new ContaBancaria(500);


$conta1->depositar(500);
$conta1->sacar(200);

$conta2->depositar(100);
$conta2->sacar(50);

echo "Conta 1\n";
echo "Saldo: R$ " . $conta1->getSaldo() . "\n\n";

echo "Conta 2\n";
echo "Saldo: R$ " . $conta2->getSaldo() . "\n";

?>