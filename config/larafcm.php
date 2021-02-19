<?php

return [

    "authentication_key" => env('LARAFCM_AUTHENTICATION_KEY'),

    "sender_id" => env('LARAFCM_SENDER_ID'),

    "log_enabled" => true,

    /**
     * Driver protocol
     */
    'driver' => env('LARAFCM_PROTOCOL', 'http'),

    'http' => [

        /**
         * Server send notify url
         */
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',

        /**
         * timeout in second
         * @var double
         */
        'timeout'         =>  30.0,
    ],
];
