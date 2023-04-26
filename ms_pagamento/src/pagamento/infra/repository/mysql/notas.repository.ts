import { Injectable } from '@nestjs/common';
import { PrismaService } from 'src/core/prisma.service';
import { Notas } from 'src/pagamento/dominio/Notas';
import { AtualizarNotaCommand } from 'src/pagamento/dominio/command/AtualizarNota.command';
import { CriarNotaCommand } from 'src/pagamento/dominio/command/CriarNota.command';

@Injectable()
export class NotasRepository {
  constructor(private readonly prismaService: PrismaService) {}

  async criar(criarNotaCommand: CriarNotaCommand): Promise<Notas | false> {
    try {
      return await this.prismaService.notas.create({
        data: criarNotaCommand,
      });
    } catch (error) {
      return false;
    }
  }

  async buscar(id: number): Promise<Notas | false> {
    try {
      return await this.prismaService.notas.findFirst({
        where: {
          id,
        },
      });
    } catch (error) {
      return false;
    }
  }

  async atualizar({
    id,
    total_itens,
    valor,
  }: AtualizarNotaCommand): Promise<Notas | false> {
    try {
      const update: any = {};

      if (total_itens) {
        update.total_itens = total_itens;
      }

      if (valor) {
        update.valor = valor;
      }

      return await this.prismaService.notas.update({
        data: update,
        where: {
          id,
        },
      });
    } catch (error) {
      return false;
    }
  }

  async listar(): Promise<Notas[] | false> {
    try {
      const resultado = await this.prismaService.notas.findMany();

      if (resultado.length <= 0) {
        return false;
      }

      return resultado;
    } catch (error) {
      return false;
    }
  }
}
