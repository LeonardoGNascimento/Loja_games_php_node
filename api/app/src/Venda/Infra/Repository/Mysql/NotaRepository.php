<?php

namespace App\src\Venda\Infra\Repository\Mysql;

use App\src\Venda\Dominio\Command\SalvarNotaCommand;
use App\src\Venda\Dominio\Model\Nota;

class NotaRepository
{
    public function store(SalvarNotaCommand $salvarNotaCommand)
    {
        return Nota::create(
            $salvarNotaCommand->destruct()
        );
    }
}
