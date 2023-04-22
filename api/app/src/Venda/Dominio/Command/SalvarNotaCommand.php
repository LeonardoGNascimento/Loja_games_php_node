<?php

namespace App\src\Venda\Dominio\Command;

use App\src\Core\Command;

class SalvarNotaCommand extends Command
{
    public function __construct(
        public int $id_usuario,
        public int $total_itens,
        public int $valor
    ) {
    }
}
