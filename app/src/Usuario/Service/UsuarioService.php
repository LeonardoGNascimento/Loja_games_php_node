<?php

namespace App\src\Usuario\Service;

use App\src\Usuario\Model\Usuario;
use App\src\Usuario\Repository\UsuarioRepository;
use App\src\Usuario\Request\UsuarioRequest;

class UsuarioService
{
    public function __construct(
        protected UsuarioRepository $usuarioRepository
    ) {
    }

    public function store(UsuarioRequest $request): Usuario
    {
        $usuario = new Usuario();
        $usuario->nome = $request['nome'];
        $usuario->email = $request['email'];
        $usuario->telefone = $request['telefone'];
        $usuario->senha = md5($request['senha']);

        $this->usuarioRepository->store($usuario);

        return $usuario;
    }
}
