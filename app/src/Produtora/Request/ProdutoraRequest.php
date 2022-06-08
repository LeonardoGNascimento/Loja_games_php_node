<?php

namespace App\src\Produtora\Request;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoraRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string'
        ];
    }
}
