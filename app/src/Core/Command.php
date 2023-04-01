<?php

namespace App\src\Core;

use App\Exceptions\BadRequestException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

abstract class Command
{
    public $rules = [];

    public function destruct()
    {
        foreach ($this as $key => $value) {
            if ($key != "rules") {
                $retorno[$key] = $value;
            }
        }

        return $retorno;
    }

    public function validate()
    {
        try {
            Validator::make($this->destruct(), $this->rules)->validate();
        } catch (ValidationException $e) {
            throw new BadRequestException($e->getMessage(), $e->errors());
        }
    }
}
