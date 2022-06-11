<?php

namespace App\src\Usuario\Request;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string',
            'email' => 'required|string',
            'telefone' => 'required|string',
            'senha' => 'required|string'
        ];
    }
}
