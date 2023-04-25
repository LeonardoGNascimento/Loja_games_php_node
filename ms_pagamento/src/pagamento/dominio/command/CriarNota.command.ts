import { Decimal } from '@prisma/client/runtime';
import { IsInt, IsNotEmpty, IsNumber } from 'class-validator';

export class CriarNotaCommand {
  total_itens: number = 0;

  @IsInt({ message: 'id_usuario deve ser do tipo inteiro' })
  @IsNotEmpty({ message: 'id_usuario é obrigatório' })
  id_usuario: number;

  valor: number = 0;
}
