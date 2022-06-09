<?php

namespace App\src\Jogos\Controller;

use App\src\Jogos\Request\GeneroRequest;
use Illuminate\Http\JsonResponse;

interface IGenerosController
{
    public function index(): JsonResponse;
    public function store(GeneroRequest $request): JsonResponse;
    public function show($idGenero): JsonResponse;
}
