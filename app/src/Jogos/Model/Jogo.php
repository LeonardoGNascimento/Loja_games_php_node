<?php

namespace App\src\Jogos\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 
        'faixa_etaria', 
        'id_genero', 
        'id_produtora',
        'valor'
    ];
}
