<?php

namespace App\src\Jogos\Aplicativo\Controller;

use App\src\Jogos\Aplicativo\Request\GeneroRequest;
use Illuminate\Http\JsonResponse;

interface IGenerosController
{
    public function index(): JsonResponse;
    public function store(GeneroRequest $request): JsonResponse;
    public function show(int $idGenero): JsonResponse;
}
