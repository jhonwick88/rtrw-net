<?php

namespace App\Traits;

trait JsonResponseTrait
{
    public function successResponse($data, $option = null, $message = 'success', $code = 0)
    {
        return response()->json($this->responseBag($code, $message, $data, $option), 200);
    }

    public function failedResponse($message, $data = [], $code = -1, $httpCode = 200)
    {
        return response()->json($this->responseBag($code, $message, $data), $httpCode);
    }

    public function responseBag($code, $message, $data, $option = null)
    {
        return [
            'code' => $code,
            'message' => $message,
            'data' => $data,
            'option' => $option
        ];
    }
}
