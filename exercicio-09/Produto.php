<?php

namespace Exercicio_09;
class Produto
{
    public function __construct(
        private string $nome,
        private int $qtd,
        private float $preco
    ) {

    }

    public function getNome(): string
    {
        return $this->nome;
    }
    public function getQtd(): int
    {
        return $this->qtd;
    }
    public function getPreco(): float
    {
        return $this->preco;
    }
    public function setQtd(int $qtd)
    {
        $this->qtd = $qtd;
    }
    public function setPreco(float $preco)
    {
        $this->preco = $preco;
    }
}