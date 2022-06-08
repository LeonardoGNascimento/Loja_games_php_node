<?php

namespace App\src\Usuario\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'sobrenome',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cep',
        'cidade',
        'estado',
        'telefone',
        'celular',
        'tipo_sanguineo',
        'profissao',
        'local_trabalho'
    ];
}
