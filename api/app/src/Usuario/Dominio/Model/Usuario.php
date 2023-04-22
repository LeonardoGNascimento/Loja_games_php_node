<?php

namespace App\src\Usuario\Dominio\Model;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'senha',
    ];

    protected $hidden = [
        'senha',
        "created_at",
        "updated_at"
    ];
}
