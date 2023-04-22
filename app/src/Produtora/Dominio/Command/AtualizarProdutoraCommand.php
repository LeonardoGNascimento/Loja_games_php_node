<?php

namespace App\src\Produtora\Dominio\Command;

use App\src\Core\Command;

class AtualizarProdutoraCommand extends Command
{
    public function __construct(
        public int $id,
        public ?string $nome = null
    ) {
    }
}
