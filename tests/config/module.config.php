<?php

return [
    'phpro_encoding_com' => [
        'api' => [
            'user_id' => 'userid',
            'user_key' => 'userkey',
        ],
        'notify' => [
            'format' => 'xml',
            'notify_route' => 'encodingcom/notify',
            'notify_service' => 'custom-notify-service-key',
        ],
        'local_tunnel' => [
            'enabled' => false,
            'host' => 'subdomain.ngrok.com',
        ],
        'hash' => 'hash',
    ],
];