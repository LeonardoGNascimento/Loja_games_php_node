<?php

namespace App\src\Venda\Repository;

use App\src\Venda\Model\Nota;
use App\src\Venda\Model\Venda;

class VendasRepository
{
    public function store(Nota $nota)
    {
        return $nota->save();
    }

    public function salvarVenda(Venda $venda)
    {
        return $venda->save();
    }
}
