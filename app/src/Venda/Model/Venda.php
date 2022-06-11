<?php

namespace App\src\Venda\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jogo',
        'id_nota'
    ];
}
