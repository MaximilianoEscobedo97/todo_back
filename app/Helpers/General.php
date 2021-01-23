<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Validator;

class General
{
    public static function makeResponse($body = [], $status = 200, $success = true)
    {
        $body = ['success' => $success] + $body;
        return response()->json($body, $status,[],JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
    }

    public static function validateRequest($request, $rules = null)
    {
        $validator = Validator::make($request, $rules);
        return $validator->fails() ? General::makeResponse($validator->errors()->toArray(), 400, false) : [];
    }
}