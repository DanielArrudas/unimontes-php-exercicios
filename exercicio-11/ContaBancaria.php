<?php

namespace Exercicio_11;

class ContaBancaria
{
    private int $saldo = 0;
    public function __construct()
    {
    }

    public function parseInput(float $valor): int
    {
        return floor($valor * 100);
    }
    public function parseOutput(int $valor): float
    {
        return (float) $valor / 100;
    }
    public function sacar(float $valor): bool
    {
        $valor = $this->parseInput($valor);
        if ($this->saldo >= $valor) {
            $this->saldo -= $valor;
            return true;
        }
        return false;
    }
    public function depositar(float $valor): void
    {
        $this->saldo += $this->parseInput($valor);
    }
    public function getSaldo(): float
    {
        return $this->parseOutput($this->saldo);
    }

    public function setSaldo($saldo)
    {
        $this->saldo = $this->parseInput($saldo);
    }


}