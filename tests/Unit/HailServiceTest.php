<?php

namespace Tests\Unit;

use App\Services\HailService;
use Tests\TestCase;

class HailServiceTest extends TestCase
{
    public function test_retrieve_articles()
    {
        $articles = HailService::getArticles();

        $this->assertIsArray($articles);
        $this->assertGreaterThan(0, count($articles));
        $this->assertObjectHasAttribute('title', $articles[0]);
    }
}
