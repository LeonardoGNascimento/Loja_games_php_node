import { Module } from '@nestjs/common';
import { PrismaService } from 'src/core/prisma.service';
import { VendaController } from './aplicacao/controller/venda.controller';
import { NotaController } from './aplicacao/controller/notas.controller';
import { VendaService } from './aplicacao/service/venda.service';
import { NotasService } from './aplicacao/service/notas.service';
import { NotasRepository } from './infra/repository/mysql/notas.repository';
import { VendaRepository } from './infra/repository/mysql/venda.repository';

@Module({
  controllers: [VendaController, NotaController],
  providers: [
    PrismaService,
    VendaService,
    NotasService,
    NotasRepository,
    VendaRepository
  ],
})
export class PagamentoModule {}
