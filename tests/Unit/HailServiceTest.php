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
        $this->assertObjectHasAttribute('id', $articles[0]);
        $this->assertObjectHasAttribute('title', $articles[0]);
        $this->assertObjectHasAttribute('url', $articles[0]);
    }

    public function test_retrieve_organisations()
    {
        $organisations = HailService::getOrganisations();

        $this->assertIsArray($organisations);
        $this->assertGreaterThan(0, count($organisations));
        $this->assertObjectHasAttribute('id', $organisations[0]);
        $this->assertObjectHasAttribute('name', $organisations[0]);
    }
}
