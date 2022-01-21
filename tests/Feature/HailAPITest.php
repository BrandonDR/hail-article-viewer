<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class HailAPITest extends TestCase
{
    public function test_local_articles_api()
    {
        Cache::flush();
        $response = $this->get('/api/articles');

        $response->assertStatus(200);

        $articles = json_decode($response->getContent());
        $this->assertIsArray($articles);
        $this->assertGreaterThan(0, count($articles));
        $this->assertObjectHasAttribute('title', $articles[0]);
    }
}
