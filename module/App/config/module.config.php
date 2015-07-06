<?php

return [
    'service_manager' => [
        'factories' => [
            'App\Auth\UserCredentialsCallable' => 'App\Factory\UserCredentialsFactory'
        ]
    ]
];
