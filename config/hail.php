<?php

$endpoint = env('HAIL_ENDPOINT', 'https://hail.to');

return [
    'client_id' => env('HAIL_CLIENT_ID'),
    'secret' => env('HAIL_SECRET'),

    'endpoint' => $endpoint . '/api',
    'authorize_url' => $endpoint . '/oauth/authorise',
    'access_token_url' => $endpoint . '/api/v1/oauth/access_token',
    'resource_owner_details_url' => $endpoint . '/api/v1/oauth/access_token',

    'organisation_id' => env('HAIL_ORG_ID'),

    'scopes' => 'user.basic content.read'
];
