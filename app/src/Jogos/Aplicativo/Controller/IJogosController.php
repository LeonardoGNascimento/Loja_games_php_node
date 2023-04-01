<?php

namespace App\src\Jogos\Aplicativo\Controller;

use App\src\Jogos\Aplicativo\Request\JogoRequest;
use Illuminate\Http\JsonResponse;

interface IJogosController
{
    public function store(JogoRequest $request): JsonResponse;
}
