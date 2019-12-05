<?php
return [
    [
        'POST',
        '/auth/login',
        [
            'uses' => ''
        ]
    ],
    [
        'GET',
        '/institutions',
        [
            'uses' => 'App\\Controllers\\InstitutionsController',
            'middleware' => null
        ]
    ],
    [
        'POST',
        '/institutions',
        [
            'uses' => 'App\\Controllers\\InstitutionsController',
            'middleware' => null
        ]
    ],
    [
        'GET',
        '/institutions/{institutionId}',
        [
            'uses' => 'App\\Controllers\\InstitutionsController',
            'middleware' => null
        ]
    ],
    [
        'PATCH',
        '/institutions/{institutionId}',
        [
            'uses' => 'App\\Controllers\\InstitutionsController',
            'middleware' => null
        ]
    ],
    [
        'DELETE',
        '/institutions/{institutionId}',
        [
            'uses' => 'App\\Controllers\\InstitutionsController',
            'middleware' => null
        ]
    ],
    [
        'GET',
        '/plans',
        [
            'uses' => 'App\\Controllers\\PlansController',
            'middleware' => null
        ]
    ],
    [
        'POST',
        '/plans',
        [
            'uses' => 'App\\Controllers\\PlansController',
            'middleware' => null
        ]
    ],
    [
        'GET',
        '/plans/{planId}',
        [
            'uses' => 'App\\Controllers\\PlansController',
            'middleware' => null
        ]
    ],
    [
        'PATCH',
        '/plans/{planId}',
        [
            'uses' => 'App\\Controllers\\PlansController',
            'middleware' => null
        ]
    ],
    [
        'DELETE',
        '/plans/{planId}',
        [
            'uses' => 'App\\Controllers\\PlansController',
            'middleware' => null
        ]
    ],
    [
        'GET',
        '/users',
        [
            'uses' => 'App\\Controllers\\UsersController',
            'middleware' => null
        ]
    ],
    [
        'POST',
        '/users',
        [
            'uses' => 'App\\Controllers\\UsersController',
            'middleware' => null
        ]
    ],
    [
        'GET',
        '/users/{userId}',
        [
            'uses' => 'App\\Controllers\\UsersController',
            'middleware' => null
        ]
    ],
    [
        'PATCH',
        '/users/{userId}',
        [
            'uses' => 'App\\Controllers\\UsersController',
            'middleware' => null
        ]
    ],
    [
        'DELETE',
        '/users/{userId}',
        [
            'uses' => 'App\\Controllers\\UsersController',
            'middleware' => null
        ]
    ]
];
