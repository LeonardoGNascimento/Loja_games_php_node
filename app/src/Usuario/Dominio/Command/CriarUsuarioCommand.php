<?php

namespace App\src\Usuario\Dominio\Command;

use App\src\Core\Command;

class CriarUsuarioCommand extends Command
{
    public function __construct(
        public $nome,
        public $email,
        public $senha
    ) {
    }

    public function criptografarSenha()
    {
        $this->senha = md5($this->senha);
    }

    public function rules(): array
    {
        return [
            'nome' => ['required'],
            'email' => ['required'],
            'senha' => ['required', 'min:6']
        ];
    }
}
