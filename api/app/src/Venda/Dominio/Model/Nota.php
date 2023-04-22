<?php

namespace App\src\Venda\Dominio\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id_usuario',
        'total_itens',
        'valor'
    ];
}
