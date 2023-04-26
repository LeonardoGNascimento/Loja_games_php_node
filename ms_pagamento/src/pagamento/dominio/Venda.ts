import { Decimal } from '@prisma/client/runtime';
import { Notas } from './Notas';

export class Venda {
  id: number;
  id_jogo: number;
  id_nota: number;
  valor: Decimal;

  notas?: Notas;
}
