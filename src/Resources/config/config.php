<?php

use Modules\Sns\Events\SnsMessageReceived;

return [
    'key' => env('SNS_ACCESS_KEY_ID'),
    'secret' => env('SNS_SECRET_ACCESS_KEY'),
    'region' => env('SNS_DEFAULT_REGION', 'us-east-1'),
    'listeners' => [
        SnsMessageReceived::class => [

        ]
    ]
];
