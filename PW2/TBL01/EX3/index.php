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


class Carrinho
{
    private $produtos = array();

    public function adicionarProduto($produto, $quantidade)
    {
        if ($quantidade <= 0) {
            return;
        }

        if ($produto->vender($quantidade)) {
            $item = array(
                "produto" => $produto,
                "quantidade" => $quantidade
            );

            $this->produtos[] = $item;
        }
    }

    public function calcularTotal()
    {
        $total = 0;

        foreach ($this->produtos as $item) {
            $produto = $item["produto"];
            $quantidade = $item["quantidade"];

            $total = $total + ($produto->getPreco() * $quantidade);
        }

        return $total;
    }

    public function calcularQuantidadeItens()
    {
        $quantidadeTotal = 0;

        foreach ($this->produtos as $item) {
            $quantidadeTotal = $quantidadeTotal + $item["quantidade"];
        }

        return $quantidadeTotal;
    }

    public function limpar()
    {
        $this->produtos = array();
    }
}


// Criando produtos

$produto1 = new Produto("Notebook", 3500, 10);
$produto2 = new Produto("Mouse", 80, 20);


// Criando o carrinho

$carrinho = new Carrinho();


// Adicionando produtos ao carrinho

$carrinho->adicionarProduto($produto1, 2);
$carrinho->adicionarProduto($produto2, 3);


// Exibindo os resultados

echo "Quantidade total de itens: "
    . $carrinho->calcularQuantidadeItens();

echo "\n";

echo "Valor total: R$ "
    . $carrinho->calcularTotal();

echo "\n\n";


// Limpando o carrinho

$carrinho->limpar();

echo "Carrinho após limpar: "
    . $carrinho->calcularQuantidadeItens()
    . " itens";

?>
