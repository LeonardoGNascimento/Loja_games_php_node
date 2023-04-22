<?php

namespace App\src\Venda\Infra\Repository\Mysql;

use App\src\Venda\Dominio\Command\SalvarVendaCommand;
use App\src\Venda\Dominio\Model\Venda;
use Exception;

class VendasRepository
{
    public function store(SalvarVendaCommand $salvarVendaCommand): ?Venda
    {
        try {
            $resultado = Venda::create($salvarVendaCommand->destruct());

            if (empty($resultado)) {
                return null;
            }

            return $resultado;
        } catch (Exception $error) {
            return null;
        }
    }
}
