<?php

namespace App\src\Jogos\Request;

use Illuminate\Foundation\Http\FormRequest;

class JogoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "nome" => "required|string",
            "faixa_etaria" => "required|int",
            "id_genero" => "required|int",
            "id_produtora" => "required|integer",
            "valor" => "required"
        ];
    }
}
