<?php

namespace App\src\Core;

use App\Exceptions\BadRequestException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

abstract class Command implements ICommand
{
    public function destruct(): array
    {
        foreach ($this as $key => $value) {
            $retorno[$key] = $value;
        }

        return $retorno;
    }

    public function validate()
    {
        try {
            Validator::make($this->destruct(), $this->rules())->validate();
        } catch (ValidationException $e) {
            throw new BadRequestException($e->getMessage(), $e->errors());
        }
    }

    public function rules(): array
    {
        return [];
    }
}
