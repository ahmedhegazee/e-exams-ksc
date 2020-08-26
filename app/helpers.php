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
function getHerokuDatabaseData($url)
{
    //heroku pgsql database guide
    //https://medium.com/@juangsalazprabowo/how-to-deploy-a-laravel-app-into-heroku-df55efbf8e4e
    //path is database name
    //add the config in the settings of app and don't change your database config file
    $DATABASE_URL = parse_url($url);
    $DATABASE_URL = array_merge($DATABASE_URL, ['path' => ltrim($DATABASE_URL['path'], '/')]);
    $dbName = $DATABASE_URL['path'];
    array_pop($DATABASE_URL);
    $DATABASE_URL['db_name'] = $dbName;
    return $DATABASE_URL;
}