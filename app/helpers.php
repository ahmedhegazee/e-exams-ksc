<?php

use Twilio\Rest\Client as RestClient;

// we add this file in the composer file
// add this section in the autoload section
/*
  "files": [
            "App/helpers.php"
        ],
 */
// to allow the class be defined in the loading of the application
function jsonResponse($message, $data = null, $responseStatus = 200)
{
    $response = [
        'message' => $message,
        'data' => $data
    ];
    return response()->json($response, $responseStatus, [], JSON_UNESCAPED_UNICODE);
}