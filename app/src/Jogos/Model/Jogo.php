<?php

namespace App\src\Jogos\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
    use HasFactory;

    public string $nome;
    public string $faixa_etaria;
    public int $genero;
    public int $id_produtora;

    protected $fillable = [
        'nome', 'faixa_etaria', 'genero', 'id_produtora
        '
    ];
}
