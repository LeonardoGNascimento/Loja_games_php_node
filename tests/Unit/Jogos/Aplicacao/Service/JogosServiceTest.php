<?php

namespace Tests\Unit\Jogos\Aplicacao\Service;

use App\Exceptions\HttpException;
use App\src\Jogos\Aplicativo\Service\GenerosService;
use App\src\Jogos\Aplicativo\Service\JogosService;
use App\src\Jogos\Dominio\Model\Jogo;
use App\src\Jogos\Infra\Repository\JogosRepository;
use App\src\Produtora\Aplicacao\Service\ProdutoraService;
use Tests\TestCase;

class JogosServiceTest extends TestCase
{
    public $jogo;
    public $mockJogosRepository;
    public $mockGenerosService;
    public $mockProdutoraService;
    public JogosService $jogoService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->jogo = new Jogo([
            "nome" => 'Jogo',
            "faixa_etaria" => 12,
            "id_genero" => 1,
            "id_produtora" => 1,
            "valor" => 100.50
        ]);

        $this->mockJogosRepository = self::createMock(JogosRepository::class);
        $this->mockGenerosService = self::createMock(GenerosService::class);
        $this->mockProdutoraService = self::createMock(ProdutoraService::class);
        $this->jogoService = new JogosService($this->mockJogosRepository, $this->mockGenerosService, $this->mockProdutoraService);
    }

    public function testQuandoCadastroUmNovoJogoDeveMeRetornarSucesso()
    {
        $this->mockJogosRepository->method('store')->willReturn($this->jogo);
        $this->mockGenerosService->method('show')->willReturn(!null);
        $this->mockProdutoraService->method('show')->willReturn(!null);

        $resultado = $this->jogoService->store($this->jogo);

        self::assertEquals($resultado->nome, $this->jogo->nome);
    }

    public function testQuandoCadastroUmNovoJogoSemUmGeneroExistenteDeveMeRetornarException()
    {
        try {
            $this->mockJogosRepository->method('store')->willReturn($this->jogo);
            $this->mockGenerosService->method('show')->willReturn(
                $this->throwException(new HttpException('Nenhum gênero encontrado'))
            );
            $this->mockProdutoraService->method('show')->willReturn(!null);
            $this->jogoService->store($this->jogo);
        } catch (HttpException $error) {
            self::assertInstanceOf(HttpException::class, $error);
            self::assertEquals('Nenhum gênero encontrado', $error->getMessage());
        }
    }

    public function testQuandoTentoListarTodosOsJogosDeveMeRetornarSucesso()
    {
        $this->mockJogosRepository->method('index')->willReturn([$this->jogo, $this->jogo]);
        $resultado = $this->jogoService->index($this->jogo);

        self::assertNotNull($resultado);
    }

    public function testQuandoTentoListarTodosOsJogosSemNenhumJogoCadastradoDeveMeRetornarSucesso()
    {
        try {
            $this->mockJogosRepository->method('index')->willReturn(null);
            $this->jogoService->index($this->jogo);
        } catch (HttpException $error) {
            self::assertInstanceOf(HttpException::class, $error);
            self::assertEquals('Nenhum jogo encontrado', $error->getMessage());
        }
    }

    public function testQuandoTentoBuscarUmJogoDeveMeRetornarSucesso()
    {
        $this->mockJogosRepository->method('show')->willReturn($this->jogo);

        $resultado = $this->jogoService->show(1);
        self::assertEquals($this->jogo->nome, $resultado->nome);
    }

    public function testQuandoTentoBuscarUmJogoQueNaoExisteDeveMeRetornarException()
    {
        try {
            $this->mockJogosRepository->method('show')->willReturn(null);
            $this->jogoService->show(1);
        } catch (HttpException $error) {
            self::assertInstanceOf(HttpException::class, $error);
            self::assertEquals('Jogo não encontrado!', $error->getMessage());
        }
    }
}
