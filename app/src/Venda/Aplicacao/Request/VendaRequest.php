<?php

namespace App\src\Venda\Aplicacao\Request;

use Illuminate\Foundation\Http\FormRequest;

class VendaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_jogo' => 'required|array'
        ];
    }
}
