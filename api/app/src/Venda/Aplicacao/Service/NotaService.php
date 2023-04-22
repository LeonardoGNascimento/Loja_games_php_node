<?php

namespace App\src\Venda\Aplicacao\Service;

use App\Exceptions\BadRequestException;
use App\Exceptions\HttpException;
use App\src\Jogos\Aplicativo\Service\JogosService;
use App\src\Usuario\Dominio\Model\Usuario;
use App\src\Venda\Dominio\Command\SalvarNotaCommand;
use App\src\Venda\Dominio\Command\SalvarVendaCommand;
use App\src\Venda\Dominio\Model\Nota;
use App\src\Venda\Infra\Repository\Mysql\NotaRepository;
use Exception;

class NotaService
{
    public function __construct(
        public NotaRepository $notaRepository,
        public JogosService $jogosService,
        public VendaService $vendaService
    ) {
    }

    public function salvar(Usuario $usuario, array $id_jogos): Nota
    {
        try {
            $valorTotal = array_reduce($id_jogos, function ($acumulado, $id_jogo) {
                return $acumulado + ($this->jogosService->show($id_jogo))->valor;
            }, 0);
        } catch (Exception $error) {
            throw new HttpException($error->getMessage(), $error->getCode());
        }

        $nota = $this->store(
            new SalvarNotaCommand(
                id_usuario: $usuario->id,
                total_itens: count($id_jogos),
                valor: $valorTotal
            )
        );

        foreach ($id_jogos as $id_jogo) {
            $this->vendaService->store(
                new SalvarVendaCommand(
                    id_jogo: $id_jogo,
                    id_nota: $nota->id
                )
            );
        }

        return $nota;
    }

    public function store(SalvarNotaCommand $salvarNotaCommand)
    {
        $resultado = $this->notaRepository->store($salvarNotaCommand);

        if (empty($resultado)) {
            throw new BadRequestException('Ocorreu um erro ao salvar nota');
        }

        return $resultado;
    }
}
