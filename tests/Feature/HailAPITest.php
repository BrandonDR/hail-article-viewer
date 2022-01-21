<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Cache;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class HailAPITest extends TestCase
{
    public function test_local_articles_api_without_cache()
    {
        Cache::flush();
        $response = $this->get('/api/articles');

        $response->assertStatus(200);
        $this->assertBodyHasArticles($response);
    }

    public function test_local_articles_api_with_cache()
    {
        Cache::flush();
        $deltas = [];
        for ($i = 0; $i < 2; $i++) {
            $timeStart = microtime(true);
            $response = $this->get('/api/articles');
            $deltas[] = microtime(true) - $timeStart;

            $response->assertStatus(200);

            $this->assertBodyHasArticles($response);
        }

        $this->assertLessThan(
            $deltas[0],
            $deltas[1],
            'Cached request must be quicker than source API'
        );
    }

    private function assertBodyHasArticles(TestResponse $response)
    {
        $articles = json_decode($response->getContent());

        $this->assertIsArray($articles);
        $this->assertGreaterThan(0, count($articles));
        $this->assertObjectHasAttribute('title', $articles[0]);
    }
}
