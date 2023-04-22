<?php

namespace App\src\Venda\Dominio\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id_jogo',
        'id_nota'
    ];
}
