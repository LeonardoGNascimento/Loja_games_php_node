<?php

namespace App\src\Jogos\Dominio\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'nome', 
        'faixa_etaria', 
        'id_genero', 
        'id_produtora',
        'valor'
    ];
}
