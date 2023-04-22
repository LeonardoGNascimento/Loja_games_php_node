<?php

namespace App\src\Venda\Aplicacao\Service;

use App\Exceptions\BadRequestException;
use App\src\Venda\Dominio\Command\SalvarVendaCommand;
use App\src\Venda\Dominio\Model\Venda;
use App\src\Venda\Infra\Repository\Mysql\VendasRepository;

class VendaService
{
    public function __construct(
        private VendasRepository $vendasRepository
    ) {
    }

    public function store(SalvarVendaCommand $salvarVendaCommand): Venda
    {
        $resultado = $this->vendasRepository->store($salvarVendaCommand);

        if (empty($resultado)) {
            throw new BadRequestException('Ocorreu um erro ao salvar venda');
        }

        return $resultado;
    }
}
