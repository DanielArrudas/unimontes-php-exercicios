<?php

namespace Exercicio_10;

use DateTime;

class Compromisso
{
    private DateTime $dateTime;
    private string $descricao;
    public function __construct(string $descricao, DateTime $dateTime)
    {
        $this->descricao = $descricao;
        $this->dateTime = $dateTime;
    }
    public function getDateTime(){
        return $this->dateTime;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }
}