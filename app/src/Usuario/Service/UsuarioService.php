<?php

namespace App\src\Usuario\Service;

use App\Enum\HttpStatus;
use App\Exceptions\HttpException;
use App\Models\User;
use App\src\Usuario\Repository\UsuarioRepository;
use App\src\Usuario\Request\LoginRequest;
use App\src\Usuario\Request\UsuarioRequest;
use Illuminate\Support\Facades\Auth;

class UsuarioService
{
    public function __construct(
        protected UsuarioRepository $usuarioRepository
    ) {
    }

    public function store(UsuarioRequest $request): User
    {
        $usuario = new User();
        $usuario->name = $request['name'];
        $usuario->email = $request['email'];
        $usuario->password = bcrypt($request['password']);

        $this->usuarioRepository->store($usuario);

        return $usuario;
    }

    public function login(LoginRequest $request)
    {
        $credenciais = $request->only('email', 'password');

        $logar = Auth::attempt($credenciais);

        if(!$logar) {
            throw new HttpException('Usuário inválido', HttpStatus::HTTP_UNAUTHORIZED->value);
        }

        $user = Auth::user();
        return $user->createToken('JWT')->plainTextToken;
    }
}
