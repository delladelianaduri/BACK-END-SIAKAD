<?php

return [

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Secret
    |--------------------------------------------------------------------------
    |
    | Set this in your .env file, required to generate the JWT
    |
    */

    'secret' => env('JWT_SECRET', 'your_secret_key'),

    /*
    |--------------------------------------------------------------------------
    | JWT time to live
    |--------------------------------------------------------------------------
    |
    | Specify the length of time (in minutes) that the token will be valid for.
    | Defaults to 1 hour.
    |
    */

    'ttl' => env('JWT_TTL', 60),

];