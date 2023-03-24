<?php


namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

trait ResponseTraits
{
    /**
     * @param        $data
     * @param  string  $message
     */
    function responseOk($data, $message = '')
    {
        $responseFormat = [
            'status'  => 'ok',
            'message' => $message ?: 'Operation Successful',
            'payload' => $data,

        ];

        return response()->json($responseFormat, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * @param        $data
     * @param  string  $message
     *
     * @return JsonResponse
     */
    function responseCreated($data, $message = 'null')
    {
        $responseData = [
            'status'  => 'ok',
            'message' => $message ?: 'Data created Successfully',
            'payload' => $data,
        ];

        return response()->json($responseData, 201, [], JSON_PRETTY_PRINT);
    }

    /**
     * @param  int  $total
     * @param        $data
     * @param  string  $message
     *
     * @return JsonResponse
     */
    function responsePaginate($models, $message = '')
    {
        $responseData = [
            'status'    => 'ok',
            'message'   => $message ?: 'Data loaded successfully',
            'payload'   => $models->items(),
            'metadata' => [
                "pagination" => [
                    'total'        => $models->total(),
                    'per_page'     => $models->perPage(),
                    'last_page'    => $models->lastPage(),
                    'current_page' => $models->currentPage(),
                    'from'         => $models->firstItem(),
                    'to'           => $models->lastItem(),
                ],
            ],
        ];

        return response()->json($responseData, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * @param  int  $code
     * @param  string  $message
     * @return JsonResponse
     */
    function responseError($code = 500, $message = '')
    {
        $responseData = [
            'status'  => 'error',
            'code'    => $code,
            'message' => $message ?: 'There was some error.',
        ];

        return response()->json($responseData, $code, [], JSON_PRETTY_PRINT);
    }

}
