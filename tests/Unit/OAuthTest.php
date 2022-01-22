<?php

namespace Tests\Unit;

use App\Models\OAuth;
use Tests\TestCase;

class OAuthTest extends TestCase
{
    public function test_hail_refresh_oauth()
    {
        $oauth = OAuth::whereProvider('hail')->firstOrFail();

        $oldRefreshToken = $oauth->refresh_token;
        $oldAccessToken = $oauth->access_token;
        $oldExpiresAt = $oauth->expires_at;

        $oauth->refreshAccessToken();
        $this->assertNotEquals($oauth->refresh_token, $oldRefreshToken);
        $this->assertNotEquals($oauth->access_token, $oldAccessToken);
        $this->assertNotEquals($oauth->expires_at, $oldExpiresAt);
    }
}
