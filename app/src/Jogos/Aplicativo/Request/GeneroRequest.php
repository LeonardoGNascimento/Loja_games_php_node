<?php

namespace App\src\Jogos\Aplicativo\Request;

use Illuminate\Foundation\Http\FormRequest;

class GeneroRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "nome" => "required|string"
        ];
    }
}
