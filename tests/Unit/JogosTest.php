<?php

namespace Tests\Unit;

use App\Exceptions\HttpException;
use App\src\Jogos\Dominio\Model\Jogo;
use App\src\Jogos\Repository\JogosRepository;
use App\src\Jogos\Service\GenerosService;
use App\src\Jogos\Service\JogosService;
use App\src\Produtora\Service\ProdutoraService;
use PHPUnit\Framework\TestCase;

class JogosTest extends TestCase
{
    protected function setUp(): void
    {
        $this->jogo = new Jogo();
        $this->jogo->nome = 'Jogo';
        $this->jogo->faixa_etaria = 12;
        $this->jogo->id_genero = 1;
        $this->jogo->id_produtora = 1;
        $this->jogo->valor = 100.50;


        $this->mockJogosRepository = self::createMock(JogosRepository::class);
        $this->mockGenerosService = self::createMock(GenerosService::class);
        $this->mockProdutoraService = self::createMock(ProdutoraService::class);
    }

    public function testQuandoCadastroUmNovoJogoDeveMeRetornarSucesso()
    {
        $this->mockJogosRepository->method('store')->willReturn($this->jogo);
        $this->mockGenerosService->method('show')->willReturn(!null);
        $this->mockProdutoraService->method('show')->willReturn(!null);

        $jogoService = new JogosService($this->mockJogosRepository, $this->mockGenerosService, $this->mockProdutoraService);
        $resultado = $jogoService->store($this->jogo);

        self::assertEquals($resultado->nome, $this->jogo->nome);
    }

    public function testQuandoCadastroUmNovoJogoSemUmGeneroExistenteDeveMeRetornarException()
    {
        $this->mockJogosRepository->method('store')->willReturn($this->jogo);
        $this->mockGenerosService->method('show')->willReturn(
            $this->throwException(new HttpException('Nenhum gênero encontrado'))
        );
        $this->mockProdutoraService->method('show')->willReturn(!null);

        $jogoService = new JogosService($this->mockJogosRepository, $this->mockGenerosService, $this->mockProdutoraService);
        self::expectException(HttpException::class);
        self::expectExceptionMessage('Nenhum gênero encontrado');
        $jogoService->store($this->jogo);
    }

    public function testQuandoTentoListarTodosOsJogosDeveMeRetornarSucesso()
    {
        $this->mockJogosRepository->method('index')->willReturn([$this->jogo, $this->jogo]);

        $jogoService = new JogosService($this->mockJogosRepository, $this->mockGenerosService, $this->mockProdutoraService);
        $resultado = $jogoService->index($this->jogo); 

        self::assertNotNull($resultado);
    }

    public function testQuandoTentoListarTodosOsJogosSemNenhumJogoCadastradoDeveMeRetornarSucesso()
    {
        $this->mockJogosRepository->method('index')->willReturn(null);

        $jogoService = new JogosService($this->mockJogosRepository, $this->mockGenerosService, $this->mockProdutoraService);
        self::expectException(HttpException::class);
        self::expectExceptionMessage('Nenhum jogo encontrado');
        $jogoService->index($this->jogo); 
    }

    public function testQuandoTentoBuscarUmJogoDeveMeRetornarSucesso()
    {
        $this->mockJogosRepository->method('show')->willReturn($this->jogo);

        $jogoService = new JogosService($this->mockJogosRepository, $this->mockGenerosService, $this->mockProdutoraService);
        $resultado = $jogoService->show(1);
        self::assertEquals($this->jogo->nome, $resultado->nome);
    }

    public function testQuandoTentoBuscarUmJogoQueNaoExisteDeveMeRetornarException()
    {

        $this->mockJogosRepository->method('show')->willReturn(null);

        $jogoService = new JogosService($this->mockJogosRepository, $this->mockGenerosService, $this->mockProdutoraService);
        self::expectException(HttpException::class);
        self::expectExceptionMessage('Jogo não encontrado!');
        $jogoService->show(1);
    }
}