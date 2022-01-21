<?php

namespace App\Services;

use App\Models\OAuth;
use Carbon\Carbon;

class HailService
{
    public static function getOrganisations()
    {
        $oauth = OAuth::whereProvider('hail')->firstOrFail();

        $me = $oauth->getAuthenticatedResponse(
            'GET',
            'v1/me'
        );

        return $oauth->getAuthenticatedResponse(
            'GET',
            'v1/users/' . $me->id . '/organisations'
        );
    }

    public static function getArticles(): array
    {
        $oauth = OAuth::whereProvider('hail')->firstOrFail();

        return $oauth->getAuthenticatedResponse(
            'GET',
            'v1/organisations/' . config('hail.organisation_id') . '/articles'
        );
    }
}
