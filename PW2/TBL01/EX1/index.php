<?php

class Produto
{
    private $nome;
    private $preco;
    private $estoque;

    public function __construct($nome, $preco, $estoque)
    {
        $this->nome = $nome;

        if ($preco >= 0) {
            $this->preco = $preco;
        } else {
            $this->preco = 0;
        }

        if ($estoque >= 0) {
            $this->estoque = $estoque;
        } else {
            $this->estoque = 0;
        }
    }

    public function aplicarDesconto($percentual)
    {
        if ($percentual >= 0 && $percentual <= 100) {
            $desconto = $this->preco * ($percentual / 100);
            $this->preco = $this->preco - $desconto;
        }
    }

    public function reporEstoque($quantidade)
    {
        if ($quantidade > 0) {
            $this->estoque = $this->estoque + $quantidade;
        }
    }

    public function vender($quantidade)
    {
        if ($quantidade <= 0) {
            return false;
        }

        if ($quantidade > $this->estoque) {
            return false;
        }

        $this->estoque = $this->estoque - $quantidade;

        return true;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getPreco()
    {
        return $this->preco;
    }

    public function getEstoque()
    {
        return $this->estoque;
    }
}


// Criando dois produtos

$produto1 = new Produto("Notebook", 3500, 10);
$produto2 = new Produto("Mouse", 80, 20);


// Operações com o primeiro produto

$produto1->aplicarDesconto(10);
$produto1->vender(2);


// Operações com o segundo produto

$produto2->reporEstoque(5);
$produto2->vender(3);


// Exibindo os resultados

echo "Produto 1: " . $produto1->getNome() . "\n";
echo "Preço: R$ " . $produto1->getPreco() . "\n";
echo "Estoque: " . $produto1->getEstoque() . "\n\n";

echo "Produto 2: " . $produto2->getNome() . "\n";
echo "Preço: R$ " . $produto2->getPreco() . "\n";
echo "Estoque: " . $produto2->getEstoque() . "\n";

?>
