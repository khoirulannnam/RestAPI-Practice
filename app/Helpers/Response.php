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
            'message' => null,
        ],
        'data' => null,
    ];

    /**
     * Give success response.
     */
    public static function success($data = null, $code = 200, $message = 'Berhasil Dijalankan')
    {
        self::$response['meta']['status'] = 'success';
        self::$response['meta']['code'] = $code;
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }

    /**
     * Give validation response.
     */
    public static function validationError($errors)
    {
        self::$response['meta']['status'] = 'error';
        self::$response['meta']['code'] = 422;
        self::$response['meta']['message'] = 'Validation Error';
        self::$response['errors'] = $errors;

        return response()->json(self::$response, self::$response['meta']['code']);
    }

    /**
     * Give error response.
     */
    public static function error($data = null, $code = 400, $message = 'Terjadi Kesalahan')
    {
        self::$response['meta']['status'] = 'error';
        self::$response['meta']['code'] = $code;
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }
}
