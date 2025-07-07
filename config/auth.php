<?php

return [

    'defaults' => [
        'guard' => 'web',       // backend ka default guard
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [                  // backend users ke liye
            'driver' => 'session',
            'provider' => 'users',
        ],

        'register' => [             // frontend users ke liye guard
            'driver' => 'session',
            'provider' => 'registers',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'registers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Register::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 10,
        ],

        'registers' => [
            'provider' => 'registers',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];
