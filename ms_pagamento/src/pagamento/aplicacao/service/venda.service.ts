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
      throw new NotFoundException('Ocorreu um erro ao salvar vendar');
    }
    return resultado;
  }

  async criar(criarVenda: CriarVenda): Promise<Venda> {
    const nota = await this.notaService.buscar(criarVenda.id_nota);

    this.notaService.atualizar({
      id: criarVenda.id_nota,
      total_itens: nota.total_itens + 1,
      valor: Number(nota.valor) + criarVenda.valor
    })
    const resultado = await this.vendaRepository.criar(criarVenda);

    if (!resultado) {
      throw new BadRequestException('Ocorreu um erro ao salvar vendar');
    }

    return resultado;
  }
}
