<?php

namespace App\Traits;

trait SendResponse
{
    public function SendResponse($status_code, $message, $data = null)
    {
        $response = [
            'status' => $status_code,
            'message' => $message,
        ];

        if ($data) {
            $response['data'] = $data;
        }

        return response()->json($response, 200);
    }
}
