<?php

namespace App\src\Usuario\Request;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|string',
            'password' => 'required|string'
        ];
    }
}