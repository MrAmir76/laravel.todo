<?php

namespace App\Exceptions\Api;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class CustomException extends Exception
{

    public static function baseException(Request $request, Throwable $exception, $statusCode, $message): JsonResponse
    {
        return response()->json(
            [
                'status' => 'fail',
                "message" => $message,
                'error' => [
                    'error_code' => $exception->getCode(),
                    'error_message' => $exception->getMessage()
                ]
            ],
            $statusCode);
    }
}
