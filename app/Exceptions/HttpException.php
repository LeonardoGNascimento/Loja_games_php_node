<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class HttpException extends Exception
{
    public function render($request): JsonResponse
    {
        return response()->json([
            "message" => $this->getMessage(),
            "error" => $this->getCode()
        ],
            $this->getCode()
        );
    }
}
