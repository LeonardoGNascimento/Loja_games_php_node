import { BadRequestException, Injectable } from '@nestjs/common';
import { Notas } from 'src/pagamento/dominio/Notas';
import { AtualizarNotaCommand } from 'src/pagamento/dominio/command/AtualizarNota.command';
import { CriarNotaCommand } from 'src/pagamento/dominio/command/CriarNota.command';
import { NotasRepository } from 'src/pagamento/infra/repository/mysql/notas.repository';

@Injectable()
export class NotasService {
  constructor(private notasRepository: NotasRepository) {}

  async criar(criarNotaCommand: CriarNotaCommand): Promise<Notas> {
    const resultado = await this.notasRepository.criar(criarNotaCommand);

    if (!resultado) {
      throw new BadRequestException('Ocorreu um erro ao salvar nota');
    }

    return resultado;
  }

  async buscar(id: number): Promise<Notas> {
    const resultado = await this.notasRepository.buscar(id);

    if (!resultado) {
      throw new BadRequestException('Ocorreu um erro ao salvar nota');
    }

    return resultado;
  }

  async atualizar(atualizarNotaCommand: AtualizarNotaCommand): Promise<Notas> {
    const resultado = await this.notasRepository.atualizar(
      atualizarNotaCommand,
    );

    if (!resultado) {
      throw new BadRequestException('Ocorreu um erro ao salvar nota');
    }

    return resultado;
  }

  async listar() {
    return await this.notasRepository.listar();
  }
}
