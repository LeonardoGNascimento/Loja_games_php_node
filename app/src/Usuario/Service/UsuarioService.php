<?php

namespace App\src\Usuario\Service;

use App\Dominio\Usuario\Model\Usuario;
use App\Dominio\Usuario\Repository\UsuarioRepository;
use App\Dominio\Usuario\Request\UsuarioRequest;

class UsuarioService
{
    protected UsuarioRepository $usuarioRepository;

    public function __construct()
    {
        $this->usuarioRepository = new UsuarioRepository();
    }

    public function store(UsuarioRequest $request): ?Usuario
    {
        return $this->usuarioRepository->store($request);
    }
}
