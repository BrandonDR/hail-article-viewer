<?php

namespace Tests\Unit;

use App\Services\HailService;
use PHPUnit\Framework\TestCase;

class HailServiceTest extends TestCase
{
    public function test_retrieve_articles()
    {
        $service = new HailService;
        $service->authenticate();
        $articles = $service->getArticles();

        $this->assertIsArray($articles);
        $this->assertGreaterThan(0, count($articles));
        $this->assertArrayHasKey('title', $articles[0]);
    }
}
