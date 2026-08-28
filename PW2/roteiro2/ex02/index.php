<?php

$produtos = [
    [
        "nome" => "Teclado",
        "preco" => 120.00,
        "estoque" => 15
    ],
    [
        "nome" => "Mouse",
        "preco" => 80.00,
        "estoque" => 10
    ],
    [
        "nome" => "Monitor",
        "preco" => 900.00,
        "estoque" => 5
    ],
    [
        "nome" => "Headset",
        "preco" => 250.00,
        "estoque" => 0
    ],
    [
        "nome" => "Webcam",
        "preco" => 300.00,
        "estoque" => 3
    ]
];

function calcularValorEstoque(float $preco, int $quantidade): float
{
    return $preco * $quantidade;
}

$totalEstoque = 0;

foreach ($produtos as $produto) {

    if ($produto["estoque"] > 0) {

        $valorEstoque = calcularValorEstoque(
            $produto["preco"],
            $produto["estoque"]
        );

        echo "Produto: " . $produto["nome"] . "\n";
        echo "Preço: R$ " . number_format($produto["preco"], 2, ',', '.') . "\n";
        echo "Estoque: " . $produto["estoque"] . "\n";
        echo "Valor em estoque: R$ " .
            number_format($valorEstoque, 2, ',', '.') . "\n";
        echo "\n";

        $totalEstoque += $valorEstoque;
    }
}

echo "Valor total do estoque: R$ " .
    number_format($totalEstoque, 2, ',', '.') ."\n";
    

?>
