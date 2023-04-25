import { Body, Controller, Get, Post } from '@nestjs/common';
import { NotasService } from '../service/notas.service';
import { CriarNotaCommand } from 'src/pagamento/dominio/command/CriarNota.command';
import { Notas } from 'src/pagamento/dominio/Notas';

@Controller('nota')
export class NotaController {
  constructor(private readonly notaService: NotasService) {}

  @Get()
  async listar() {
    return await this.notaService.listar();
  }

  @Post()
  async criar(@Body() criarNotaCommand: CriarNotaCommand): Promise<Notas> {
    return await this.notaService.criar(criarNotaCommand);
  }
}
