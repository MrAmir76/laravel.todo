<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

class BaseApiController extends Controller
{
    public static function successResponse($statusCode, $message, $data = null)
    {
        $responseData = ['status' => 'success', 'message' => $message];
        isset($data) ? $responseData += ['data' => $data] : null;
        return response()->json($responseData, $statusCode);
    }


    public static function successResource($message, $data)
    {
        return [
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ];
    }

    public static function FailResponse($statusCode, $message, $error = null)
    {
        $responseData = ['status' => 'fail', 'message' => $message];
        isset($error) ? $responseData += ['error' => $error] : null;
        return response()->json($responseData, $statusCode);
    }
}
