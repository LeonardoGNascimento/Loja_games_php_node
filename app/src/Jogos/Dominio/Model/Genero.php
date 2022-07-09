<?php
namespace App\src\Jogos\Dominio\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'nome'
    ];
}
