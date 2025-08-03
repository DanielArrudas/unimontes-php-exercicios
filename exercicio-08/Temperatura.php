<?php

namespace Exercicio_08;
class Temperatura
{

    public function __construct(private float $valor)
    {

    }
    public function celsiusParaFahrenheit(): float
    {
        return $this->valor * 1.8 + 32;
    }

    public function fahrenheitParaCelsius(): float
    {
        return ($this->valor - 32) / 1.8;
    }
}