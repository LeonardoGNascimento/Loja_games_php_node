import {
  Injectable,
  BadRequestException,
  NotFoundException,
} from '@nestjs/common';
import { Venda } from 'src/pagamento/dominio/Venda';
import { CriarVenda } from 'src/pagamento/dominio/command/CriarVenda.command';
import { VendaRepository } from 'src/pagamento/infra/repository/mysql/venda.repository';
import { NotasService } from './notas.service';

@Injectable()
export class VendaService {
  constructor(
    private vendaRepository: VendaRepository,
    private notaService: NotasService,
  ) {}

  async listar(): Promise<Venda[]> {
    const resultado = await this.vendaRepository.listar();

    if (!resultado) {
      throw new NotFoundException('Nenhuma venda encontrada');
    }

    return resultado;
  }

  async criar({ id_jogo, id_nota, valor }: CriarVenda): Promise<Venda> {
    const { total_itens, valor: valorAtual } = await this.notaService.buscar(
      id_nota,
    );

    this.notaService.atualizar({
      id: id_nota,
      total_itens: total_itens + 1,
      valor: Number(valorAtual) + valor,
    });

    const resultado = await this.vendaRepository.criar({
      id_jogo,
      id_nota,
      valor,
    });

    if (!resultado) {
      throw new BadRequestException('Ocorreu um erro ao salvar venda');
    }

    return resultado;
  }
}
