<?php

namespace App\src\Venda\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_usuario',
        'total_itens',
        'valor'
    ];
}
