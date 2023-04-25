import { Injectable } from '@nestjs/common';
import { PrismaService } from 'src/core/prisma.service';
import { Venda } from 'src/pagamento/dominio/Venda';
import { CriarVenda } from 'src/pagamento/dominio/command/CriarVenda.command';

@Injectable()
export class VendaRepository {
  constructor(private readonly prismaService: PrismaService) {}

  async listar(): Promise<Venda[] | false> {
    try {
      const resultado = await this.prismaService.vendas.findMany();

      if (resultado.length <= 0) {
        return false;
      }

      return;
    } catch (error) {
      return false;
    }
  }

  async criar(criarVenda: CriarVenda): Promise<Venda | false> {
    try {
      delete criarVenda.valor;
      return await this.prismaService.vendas.create({
        data: criarVenda,
      });
    } catch (error) {
      return false;
    }
  }
}
