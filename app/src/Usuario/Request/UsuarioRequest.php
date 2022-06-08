<?php

namespace App\src\Usuario\Request;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required',
            'sobrenome' => 'required',
            'endereco' => 'required',
            'numero' => 'required',
            'complemento' => 'required',
            'bairro' => 'required',
            'cep' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'telefone' => 'required',
            'celular' => 'required',
            'tipo_sanguineo' => 'required',
            'profissao' => 'required',
            'local_trabalho' => 'required'
        ];
    }
}
