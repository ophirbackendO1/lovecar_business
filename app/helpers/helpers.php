<?php

use Inertia\Inertia;

function sendResponse($data, $status, $message = "No message")
{
    $response = [
        'data'    => $data,
        'message' => $message,
        'status' => $status
    ];

    return response()->json($response);
}
