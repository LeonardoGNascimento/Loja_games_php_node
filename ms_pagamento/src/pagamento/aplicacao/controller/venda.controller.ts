import { Body, Controller, Get, Post } from '@nestjs/common';
import { VendaService } from '../service/venda.service';
import { CriarVenda } from 'src/pagamento/dominio/command/CriarVenda.command';
import { Venda } from 'src/pagamento/dominio/Venda';

@Controller('venda')
export class VendaController {
  constructor(private readonly vendaService: VendaService) {}

  @Get()
  async listar(): Promise<Venda[]> {
    return await this.vendaService.listar();
  }

  @Post()
  async criar(@Body() criarVenda: CriarVenda): Promise<Venda> {
    return await this.vendaService.criar(criarVenda);
  }
}
