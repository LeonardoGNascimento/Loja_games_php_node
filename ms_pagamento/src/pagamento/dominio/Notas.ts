import { Decimal } from '@prisma/client/runtime';
import { Venda } from './Venda';

export class Notas {
  id: number;
  id_usuario: number;
  total_itens: number;
  valor: Decimal;
  vendas?: Venda[];
}
