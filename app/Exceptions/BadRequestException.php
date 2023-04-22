<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class BadRequestException extends Exception
{
    public function __construct(
        $message,
        public $erros = []
    ) {
        parent::__construct($message, 400);
    }

    public function getErros()
    {
        return $this->erros;
    }

    public function render($request): JsonResponse
    {
        return response()->json(
            [
                "message" => $this->getMessage(),
                "erros" => $this->erros,
                "status" => $this->getCode()
            ],
            $this->getCode()
        );
    }
}
