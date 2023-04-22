<?php

namespace Tests\Unit\Produtora\Aplicacao\Service;

use App\Exceptions\HttpException;
use App\src\Produtora\Aplicacao\Service\ProdutoraService;
use App\src\Produtora\Dominio\Command\AtualizarProdutoraCommand;
use App\src\Produtora\Dominio\Model\Produtora;
use App\src\Produtora\Infra\Repository\Mysql\ProdutoraRepository;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class ProdutoraServiceTest extends TestCase
{
    public ProdutoraService $produtaService;
    public $produtoraRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->produtoraRepository = self::createMock(ProdutoraRepository::class);
        $this->produtaService = new ProdutoraService($this->produtoraRepository);
    }

    public function testDadoQueEuListeProdurasQuandoEncontraDeveRetornarSucesso()
    {
        $this->produtoraRepository->method('index')->willReturn(new Collection());

        $resultado = $this->produtaService->index();
        self::assertInstanceOf(Collection::class, $resultado);
    }

    public function testDadoQueEuListeProdurasQuandoNaoEncontraDeveRetornarException()
    {
        try {
            $this->produtoraRepository->method('index')->willReturn(null);
            $this->produtaService->index();
        } catch (HttpException $error) {
            self::assertInstanceOf(HttpException::class, $error);
            self::assertEquals('Nenhuma produtora encontrada!', $error->getMessage());
        }
    }

    public function testDadoQueEuBusqueUmaProduraQuandoEncontraDeveRetornarSucesso()
    {
        $this->produtoraRepository->method('show')->willReturn(new Produtora());

        $resultado = $this->produtaService->show(1);
        self::assertInstanceOf(Produtora::class, $resultado);
    }

    public function testDadoQueEuBusqueUmaProduraQuandoNaoEncontraDeveRetornarException()
    {
        try {
            $this->produtoraRepository->method('show')->willReturn(null);
            $this->produtaService->show(1);
        } catch (HttpException $error) {
            self::assertInstanceOf(HttpException::class, $error);
            self::assertEquals('Produtora não encontrada!', $error->getMessage());
        }
    }

    public function testDadoQueEuTentoAtualizarUmaProduraQuandoAtualizarDeveRetornarSucesso()
    {
        $this->produtoraRepository->method('show')->willReturn(new Produtora());
        $this->produtoraRepository->method('update')->willReturn(true);

        $resultado = $this->produtaService->update(new AtualizarProdutoraCommand(
            1,
            'teste'
        ));

        self::assertTrue($resultado);
    }

    public function testDadoQueEuTentoAtualizarUmaProduraQuandoNaoEncontrarDeveRetornarSucesso()
    {
        try {
            $this->produtoraRepository->method('show')->willReturn(null);
            $this->produtaService->update(new AtualizarProdutoraCommand(
                1,
                'teste'
            ));
        } catch (HttpException $error) {
            self::assertInstanceOf(HttpException::class, $error);
            self::assertEquals('Produtora não encontrada!', $error->getMessage());
        }
    }

    public function testDadoQueEuTentoCadastrarUmaProduraQuandoCadastrarDeveRetornarSucesso()
    {
        $this->produtoraRepository->method('buscarPorNome')->willReturn(null);
        $this->produtoraRepository->method('store')->willReturn(new Produtora());

        $resultado = $this->produtaService->store(new Produtora());

        self::assertInstanceOf(Produtora::class, $resultado);
    }

    public function testDadoQueEuTentoCadastrarUmaProdutoraQuandoEncontrarComMesmoNomeDeveRetornarException()
    {
        try {
            $this->produtoraRepository->method('buscarPorNome')->willReturn(new Produtora());
            $this->produtaService->store(new Produtora());
        } catch (HttpException $error) {
            self::assertInstanceOf(HttpException::class, $error);
            self::assertEquals('Produtora já cadastrada', $error->getMessage());
        }
    }
}
