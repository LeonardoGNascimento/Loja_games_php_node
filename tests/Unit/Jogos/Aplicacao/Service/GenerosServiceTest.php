<?php

namespace Tests\Unit\Jogos\Aplicacao\Service;

use App\Exceptions\BadRequestException;
use App\Exceptions\HttpException;
use App\src\Jogos\Aplicativo\Service\GenerosService;
use App\src\Jogos\Dominio\Command\CriarGeneroCommand;
use App\src\Jogos\Dominio\Model\Genero;
use App\src\Jogos\Infra\Repository\GenerosRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class GenerosServiceTest extends TestCase
{
    public $genero;
    public $mockGeneroRepository;
    public GenerosService $generoService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->genero = new Genero([
            "nome" => "Terror"
        ]);
        $this->mockGeneroRepository = self::createMock(GenerosRepository::class);
        $this->generoService = new GenerosService($this->mockGeneroRepository);
    }

    public function testQuandoTentoSalvarUmNovoGeneroDeveMeRetornarSucesso()
    {
        $this->mockGeneroRepository->method('store')->willReturn($this->genero);
        $this->mockGeneroRepository->method('buscarGeneroPorNome')->willReturn(null);

        $resultado = $this->generoService->store(new CriarGeneroCommand('LEO'));

        self::assertEquals($resultado->nome, $this->genero->nome);
    }

    public function testQuandoTentoSalvarUmNovoGeneroQueJaExisteDeveMeRetornarException()
    {
        try {
            $this->mockGeneroRepository->method('store')->willReturn($this->genero);
            $this->mockGeneroRepository->method('buscarGeneroPorNome')->willReturn($this->genero);
            $this->generoService->store(new CriarGeneroCommand('LEO'));
        } catch (HttpException $error) {
            self::assertInstanceOf(HttpException::class, $error);
            self::assertEquals('Gênero já cadastrado', $error->getMessage());
        }
    }

    public function testQuandoTentoSalvarUmNovoGeneroSemOsDadosNecessariosDeveMeRetornarException()
    {
        try {
            $this->generoService->store(new CriarGeneroCommand(''));
        } catch (BadRequestException $error) {
            self::assertEquals("O campo nome é obrigatório.", $error->getMessage());
            self::assertInstanceOf(BadRequestException::class, $error);
        }
    }

    public function testQuandoTentoSalvarUmNovoGeneroDeveMeRetornarException()
    {
        try {
            $this->mockGeneroRepository->method('store')->willReturn(null);
            $this->mockGeneroRepository->method('buscarGeneroPorNome')->willReturn(null);
            $this->generoService->store(new CriarGeneroCommand('TESTERSON'));
        } catch (HttpException $error) {
            self::assertInstanceOf(HttpException::class, $error);
            self::assertEquals('Ocorreu um erro ao salvar um novo gênero', $error->getMessage());
        }
    }

    public function testQuandoBuscoTodosOsGenerosDeveMeRetornarSucesso()
    {
        $this->mockGeneroRepository->method('index')->willReturn(new Collection());
        $resultado = $this->generoService->index();
        self::assertNotNull($resultado);
    }

    public function testDadoQueEuBusqueTodosOsGenerosQuandoNaoEncontrarNadaDeveRetornarException()
    {
        try {
            $this->mockGeneroRepository->method('index')->willReturn(null);
            $this->generoService->index();
        } catch (Exception $error) {
            self::assertEquals('Nenhum gênero encontrado', $error->getMessage());
        }
    }

    public function testQuandoBuscoApenasUmGeneroDeveMeRetornarUmGenero()
    {
        $this->mockGeneroRepository->method('show')->willReturn($this->genero);
        $resultado = $this->generoService->show(1);
        self::assertInstanceOf(Genero::class, $resultado);
    }

    public function testQuandoBuscoGeneroQueNaoExisteDeveMeRetornarErro()
    {
        try {
            $this->mockGeneroRepository->method('show')->willReturn(null);
            $this->generoService->show(1);
        } catch (HttpException $error) {
            self::assertInstanceOf(HttpException::class, $error);
            self::assertEquals('Nenhum gênero encontrado', $error->getMessage());
        }
    }

    public function testQuandoBuscoUmGeneroPorNomeDeveMeRetornarSucesso()
    {
        $this->mockGeneroRepository->method('buscarGeneroPorNome')->willReturn($this->genero);
        $resultado = $this->generoService->buscarGeneroPorNome($this->genero);
        self::assertEquals($this->genero->nome, $resultado->nome);
    }

    public function testQuandoBuscoUmGeneroNaoExistentePorNomeDeveMeRetornarExecption()
    {
        try {
            $this->mockGeneroRepository->method('buscarGeneroPorNome')->willReturn(null);
            $this->generoService->buscarGeneroPorNome($this->genero);
        } catch (HttpException $error) {
            self::assertInstanceOf(HttpException::class, $error);
            self::assertEquals('Nenhum gênero encontrado', $error->getMessage());
        }
    }
}
