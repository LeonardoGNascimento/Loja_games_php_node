<?php

namespace Tests\Feature;

use App\Exceptions\HttpException;
use App\src\Jogos\Model\Genero;
use App\src\Jogos\Repository\GenerosRepository;
use App\src\Jogos\Service\GenerosService;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class GenerosTest extends TestCase
{
    public function testQuandoTentoSalvarUmNovoGeneroDeveMeRetornarSucesso()
    {
        $generoService = new GenerosService(new GenerosRepository());

        $restultado_bytes = random_bytes(4);
        $request['nome'] = bin2hex($restultado_bytes);;
        $resultado = $generoService->store($request);

        $this->assertEquals($resultado->nome, $request['nome']);
    }

    public function testQuandoBuscoTodosOsGenerosDeveMeRetornarSucesso()
    {
        $generoService = new GenerosService(new GenerosRepository());
        $resultado = $generoService->index();
        $this->assertInstanceOf(Collection::class, $resultado);
    }

    public function testQuandoBuscoApenasUmGeneroDeveMeRetornarUmGenero()
    {
        $generoService = new GenerosService(new GenerosRepository());
        $resultado = $generoService->show(1);
        $this->assertInstanceOf(Genero::class, $resultado);
    }

    public function testeQuandoBuscoGeneroQueNaoExisteDeveMeRetornarErro()
    {
        $generoService = new GenerosService(new GenerosRepository());
        $this->expectException(HttpException::class);
        $generoService->show(114124214214);
    }
}
