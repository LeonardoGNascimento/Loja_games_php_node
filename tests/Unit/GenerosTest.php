<?php

namespace Tests\Feature;

use App\Exceptions\HttpException;
use App\src\Jogos\Dominio\Model\Genero;
use App\src\Jogos\Repository\GenerosRepository;
use App\src\Jogos\Service\GenerosService;
use PHPUnit\Framework\TestCase;
class GenerosTest extends TestCase
{
    protected function setUp(): void
    {
        $this->genero = new Genero();
        $this->genero->nome = 'Terror';
    }
    
    public function testQuandoTentoSalvarUmNovoGeneroDeveMeRetornarSucesso()
    {
        $mockGeneroRepository = self::createMock(GenerosRepository::class);
        $mockGeneroRepository->method('store')->willReturn($this->genero);
        $mockGeneroRepository->method('buscarGeneroPorNome')->willReturn(null);

        $generoService = new GenerosService($mockGeneroRepository);

        $resultado = $generoService->store($this->genero);

        self::assertEquals($resultado->nome, $this->genero->nome);
    }

    public function testQuandoTentoSalvarUmNovoGeneroQueJaExisteDeveMeRetornarException()
    {
        $mockGeneroRepository = self::createMock(GenerosRepository::class);
        $mockGeneroRepository->method('store')->willReturn($this->genero);
        $mockGeneroRepository->method('buscarGeneroPorNome')->willReturn($this->genero);

        $generoService = new GenerosService($mockGeneroRepository);

        self::expectException(HttpException::class);
        self::expectExceptionMessage('Gênero j cadastrado');
        $generoService->store($this->genero);
    }

    public function testQuandoBuscoTodosOsGenerosDeveMeRetornarSucesso()
    {
        $mockGeneroRepository = self::createMock(GenerosRepository::class);
        $mockGeneroRepository->method('index')->willReturn([$this->genero, $this->genero]);

        $generoService = new GenerosService($mockGeneroRepository);
        $resultado = $generoService->index();

        self::assertNotNull($resultado);
    }

    public function testQuandoBuscoApenasUmGeneroDeveMeRetornarUmGenero()
    {

        $mockGeneroRepository = self::createMock(GenerosRepository::class);
        $mockGeneroRepository->method('show')->willReturn($this->genero);

        $generoService = new GenerosService($mockGeneroRepository);
        $resultado = $generoService->show(1);
        self::assertInstanceOf(Genero::class, $resultado);
    }

    public function testQuandoBuscoGeneroQueNaoExisteDeveMeRetornarErro()
    {
        $mockGeneroRepository = self::createMock(GenerosRepository::class);
        $mockGeneroRepository->method('show')->willReturn(null);

        $generoService = new GenerosService($mockGeneroRepository);
        self::expectException(HttpException::class);
        $generoService->show(1);
    }

    public function testQuandoBuscoUmGeneroPorNomeDeveMeRetornarSucesso()
    {
        $mockGeneroRepository = self::createMock(GenerosRepository::class);
        $mockGeneroRepository->method('buscarGeneroPorNome')->willReturn($this->genero);

        $generoService = new GenerosService($mockGeneroRepository);
        $resultado = $generoService->buscarGeneroPorNome($this->genero);

        self::assertEquals($resultado->nome, $this->genero->nome);
    }

    public function testQuandoBuscoUmGeneroNaoExistentePorNomeDeveMeRetornarExecption()
    {
        $mockGeneroRepository = self::createMock(GenerosRepository::class);
        $mockGeneroRepository->method('buscarGeneroPorNome')->willReturn(null);

        $generoService = new GenerosService($mockGeneroRepository);
        self::expectException(HttpException::class);
        $generoService->buscarGeneroPorNome($this->genero);
    }
}
