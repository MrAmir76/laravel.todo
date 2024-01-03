<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use OpenApi\Annotations as OA;


/**
 * @OA\Info(title="Todo App API", version="1.0")
 *
 * @OA\Schema(
 *     schema="Links",
 *     type="object",
 *     @OA\Property(property="first", type="string",example="http://127.0.0.1:8000/api/v1/Address?page=1"),
 *     @OA\Property(property="last", type="string", example="http://127.0.0.1:8000/api/v1/Address?page=10"),
 *     @OA\Property(property="prev", type="string", example="http://127.0.0.1:8000/api/v1/Address?page=4",nullable=true,),
 *     @OA\Property(property="next", type="string", example="http://127.0.0.1:8000/api/v1/Address?page=5",nullable=true,),
 *   )
 * @OA\Schema(
 *      schema="Meta",
 *      type="object",
 *     @OA\Property(property="path", type="string", example="http://127.0.0.1:8000/api/v1/address"),
 *     @OA\Property(property="from", type="integer", example=1),
 *      @OA\Property(property="to", type="integer", example=1),
 *     @OA\Property(property="current_page", type="integer", example=1),
 *     @OA\Property(property="last_page", type="integer", example=10),
 *     @OA\Property(property="per_page", type="integer", example=5),
 *     @OA\Property(property="total", type="integer",example=10),
 *     @OA\Property(property="links", type="array", @OA\Items(
 *                           @OA\Property(property="url", type="string", nullable=true),
 *                           @OA\Property(property="label", type="string"),
 *                           @OA\Property(property="active", type="boolean"),
 *                          )
 *                   ),
 *
 *      )
 */
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
