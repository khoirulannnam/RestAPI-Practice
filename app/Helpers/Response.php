<?php

namespace App\Helpers;

/**
 * Format response.
 */
class Response
{
    /**
     * API Response
     *
     * @var array
     */
    protected static $response = [
        'meta' => [
            'code' => null,
            'status' => null,
        ],
        'data' => null,
    ];

    /**
     * Give success response.
     */
    public static function success($data = null, $code = 200)
    {
        self::$response['meta']['status'] = 'success';
        self::$response['meta']['code'] = $code;
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }

    /**
     * Give error response.
     */
    public static function error($data = null, $code = 400)
    {
        self::$response['meta']['status'] = 'error';
        self::$response['meta']['code'] = $code;
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }
}
