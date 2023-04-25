import { IsInt, IsNotEmpty, IsNumber } from 'class-validator';

export class CriarVenda {
  @IsInt({ message: 'id_jogo deve ser do tipo inteiro' })
  @IsNotEmpty({ message: 'id_jogo é obrigatório' })
  id_jogo: number;

  @IsInt({ message: 'id_nota deve ser do tipo inteiro' })
  @IsNotEmpty({ message: 'id_nota é obrigatório' })
  id_nota: number;

  @IsNotEmpty({ message: 'valor é obrigatório' })
  valor: number;
}
