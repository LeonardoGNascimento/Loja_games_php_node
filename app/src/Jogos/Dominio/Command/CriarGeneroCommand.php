<?php

namespace App\src\Jogos\Dominio\Command;

use App\src\Core\Command;

class CriarGeneroCommand extends Command
{
    public $rules = ['nome' => ['required']];

    public function __construct(
        public $nome
    ) {
    }
}
