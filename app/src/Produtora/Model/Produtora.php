<?php

namespace App\src\Produtora\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtora extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'nome',
        'faixa_etaria',
        'genero',
        'id_desenvolvedora'
    ];
}
