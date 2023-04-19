<?php

namespace App\src\Jogos\Dominio\Command;

use App\src\Core\Command;

class CriarGeneroCommand extends Command
{
    public function __construct(
        public string $nome
    ) {
    }

    public function rules(): array
    {
        return ['nome' => ['required']];
    }
}
