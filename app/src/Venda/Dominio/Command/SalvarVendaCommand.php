<?php

namespace App\src\Venda\Dominio\Command;

use App\src\Core\Command;

class SalvarVendaCommand extends Command
{
    public function __construct(
        public int $id_jogo,
        public int $id_nota
    ) {
    }
}
