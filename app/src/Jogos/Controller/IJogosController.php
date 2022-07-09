<?php

namespace App\src\Jogos\Controller;

use App\src\Jogos\Model\Jogo;
use App\src\Jogos\Request\JogoRequest;
use Illuminate\Http\JsonResponse;

interface IJogosController
{
    public function store(JogoRequest $request): JsonResponse;
}
