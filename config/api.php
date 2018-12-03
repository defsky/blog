<?php

return [
    'giftbag' => [
        'host'  => env('WEBAPI_HOST_GIFTBAG', 'localhost'),
        'port'  => env('WEBAPI_PORT_GIFTBAG', '80'),
        'path'  => env('WEBAPI_PATH_GIFTBAG', '/giftcode')
    ],
    'gameroom' => [
        'host'  => env('WEBAPI_HOST_GAMEROOM', 'localhost'),
        'port'  => env('WEBAPI_PORT_GAMEROOM', '80'),
        'path'  => env('WEBAPI_PATH_GAMEROOM', '/gameroom')
    ],
];

?>
