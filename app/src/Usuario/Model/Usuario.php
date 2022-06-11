<?php

namespace App\src\Usuario\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'telefone',
        'email',
        'senha'
    ];
}
