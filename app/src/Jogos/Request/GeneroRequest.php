<?php

namespace App\src\Jogos\Request;

use Illuminate\Foundation\Http\FormRequest;

class GeneroRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "nome" => "required|string"
        ];
    }
}
