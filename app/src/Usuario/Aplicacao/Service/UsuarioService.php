<?php

namespace App\src\Usuario\Aplicacao\Service;

use App\Exceptions\HttpException;
use App\src\Usuario\Dominio\Command\CriarUsuarioCommand;
use App\src\Usuario\Dominio\Model\Usuario;
use App\src\Usuario\Infra\Repository\Mysql\UsuarioRepository;
use Illuminate\Database\Eloquent\Collection;

class UsuarioService
{
    public function __construct(
        protected UsuarioRepository $usuarioRepository
    ) {
    }

    public function salvar(CriarUsuarioCommand $criarUsuarioCommand): Usuario
    {
        $criarUsuarioCommand->validate();
        $criarUsuarioCommand->criptografarSenha();

        $resultado = $this->usuarioRepository->salvar($criarUsuarioCommand);

        if (empty($resultado)) {
            throw new HttpException('Ocorreu um erro ao salvar um novo usuário', 400);
        }

        return $resultado;
    }

    public function listar(): Collection
    {
        $resultado = $this->usuarioRepository->listar();

        if (empty($resultado)) {
            throw new HttpException('Nenhum usuário encontrado', 404);
        }

        return $resultado;
    }
}
