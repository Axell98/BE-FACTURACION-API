<?php

if (!function_exists('responseSuccess')) {
    function responseSuccess(string $message = 'Success', $data = [], int $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status'  => true,
            'message' => $message,
            'data'    => $data
        ], $code);
    }
}

if (!function_exists('responseError')) {
    function responseError(string $message = 'Error', int $code = 500, $errors = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
            'errors'  => $errors
        ], $code);
    }
}
