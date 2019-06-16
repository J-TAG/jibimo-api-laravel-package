<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Jibimo API
    |--------------------------------------------------------------------------
    |
    | Jibimo plugin will need these configs to connect to Jibimo API and
    | perform your payments. You can obtain these configs from your panel in
    | Jibimo website.
    |
    */
    'base_url' => env('JIBIMO_BASE_URL', 'https://jibimo.com/api'),
    'api_token' => env('JIBIMO_API_TOKEN'),
];