<?php

declare(strict_types=1);

// aqui só tem pagamento para evitar fazer muitos if ai quando tiver o tipo de pagamento e so chamar ela nele tipo o pix
interface Pagamento
{
    public function pagar(float $valor): void;
}

// e aqui que o pagamento de pix vai ser processado só ele tem a chave de pix isso evita ter que passar por varios if caso seja so um pix e não cartão ou boleto
class Pix implements Pagamento
{
    private string $chave;

    public function __construct(string $chave)
    {
        $this->chave = $chave;
    }

    public function pagar(float $valor): void
    {
        printf("Pagamento de R$ %.2f via Pix (chave: %s) processado instantaneamente.\n", $valor, $this->chave);
    }
}

// aqui todos os pagamentos com cartão de credito ele tem o numero do cartão e o numero de parcelas para não precisar saber de tudo 
class CartaoCredito implements Pagamento
{
    private string $numero;
    private int $parcelas;

    public function __construct(string $numero, int $parcelas = 1)
    {
        if ($parcelas < 1) {
            throw new InvalidArgumentException('O número de parcelas deve ser ao menos 1.');
        }

        $this->numero = $numero;
        $this->parcelas = $parcelas;
    }

    public function pagar(float $valor): void
    {
        $final = substr($this->numero, -4);
        $valorParcela = $valor / $this->parcelas;
        printf(
            "Pagamento de R$ %.2f no cartão final %s, em %dx de R$ %.2f.\n",
            $valor,
            $final,
            $this->parcelas,
            $valorParcela
        );
    }
}
// aqui os pagamentos de boleto e a unica que tem a data de vencimento e procesa os boletos
class Boleto implements Pagamento
{
    private string $vencimento;

    public function __construct(string $vencimento)
    {
        $this->vencimento = $vencimento;
    }

    public function pagar(float $valor): void
    {
        printf("Boleto de R$ %.2f gerado, vencimento em %s.\n", $valor, $this->vencimento);
    }
}

// ele so vai fazer a chamada, chamando o como pagar para quem sabe fazer isso o pix cartão e boleto
class ProcessadorDePagamento
{
    public function processar(Pagamento $pagamento, float $valor): void
    {
        echo "Processando\n";
        $pagamento->pagar($valor);
    }
}


    $processador = new ProcessadorDePagamento();

    $formasDePagamento = [
        new Pix('henrique@email.com'),
        new CartaoCredito('44894765445', 3),
        new Boleto('05/09/2026'),
    ];

    foreach ($formasDePagamento as $forma) {
        $processador->processar($forma, 350.00);
        echo "\n";
    }