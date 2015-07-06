<?php

return [
    /**
     * Uncomment the factory if you are using a stateless REST API and want to authenticate your users
     * using the access tokens
     */
    'service_manager' => [
        'factories' => [
            'Zend\Authentication\AuthenticationService' => 'ZfrOAuth2Module\Server\Factory\AuthenticationServiceFactory'
        ]
    ],
    'doctrine' => [
        'entity_resolver' => [
            'orm_default' => [
                'resolvers' => [
                    'ZfrOAuth2\Server\Entity\TokenOwnerInterface' => 'App\Entity\User'
                ]
            ]
        ]
    ],

    'zfr_oauth2_server' => [
        /**
         * Doctrine object manager key
         */
        'object_manager' => 'doctrine.entitymanager.orm_default',

        /**
         * Various tokens TTL
         */
//        'authorization_code_ttl' => 120,
        'access_token_ttl'       => 3600,
        'refresh_token_ttl'      => 86400,

        /**
         * Registered grants for this server
         */
        'grants' => [
            'ZfrOAuth2\Server\Grant\PasswordGrant',
            'ZfrOAuth2\Server\Grant\RefreshTokenGrant'
        ],

        /**
         * A callable used to validate the username and password when using the
         * password grant
         */
        'owner_callable' => 'App\Auth\UserCredentialsCallable',

        /**
         * Grant plugin manager
         *
         * The configuration follows a standard service manager configuration
         */
        // 'grant_manager' => []
    ]
];
