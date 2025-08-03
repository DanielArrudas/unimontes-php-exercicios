<?php

namespace Exercicio_06;
class Pessoa
{
    private string $nome;
    private float $peso;
    private float $altura;

    public function __construct(string $nome, float $peso, float $altura)
    {
        $this->nome = $nome;
        $this->peso = $peso;
        $this->altura = $altura;
    }

    public function calculaIMC(): float
    {
        return $this->peso / ($this->altura * $this->altura);
    }

    public function getClassificacaoIMC(): string
    {
        $imc = $this->calculaIMC();
        return match (true) {
            $imc < 18.5 => "MAGREZA",
            $imc <= 24.9 => "NORMAL",
            $imc <= 29.9 => "SOBREPESO",
            $imc <= 39.9 => "OBESIDADE",
            default => "OBESIDADE GRAVE"
        };
    }

    public function getNome(): string
    {
        return $this->nome;
    }
}