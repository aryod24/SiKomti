<?php

return [
    'paths' => [
        'api/*',
        'sanctum/csrf-cookie',
        'upload-bukti',
        'storage/*',  // Add this to allow access to files in storage
    ],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'],  // Allow all origins
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];

