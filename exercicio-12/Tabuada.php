<?php

namespace Exercicio_12;

class Tabuada{
    public function __construct(private int $numero)
    {
    }

    public function gerar(): array
    {
        $tabuada = [];
        for ($i = 1; $i <= 10; $i++) {
            $tabuada[$i] = $i * $this->numero;
        }
        return $tabuada;
    }
}