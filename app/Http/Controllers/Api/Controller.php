<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Get a success response
     *
     * @param mix $message
     * @param mix $data
     * @param array $meta
     *
     * @return Illuminate\Http\Response
     */
    protected function successResponse($message, $data, array $meta = [])
    {
        return response()->json(
            array_merge([
                'data' => $data,
                'message' => $message,
                'success' => true,
            ], $meta), 200);
    }

    /**
     * Get an error response
     *
     * @param mix $message
     *
     * @return Illuminate\Http\Response
     */
    protected function errorResponse($message)
    {
        return response()->json([
            'errors' => (array) $message,
            'success' => false,
        ], 422);
    }

}
