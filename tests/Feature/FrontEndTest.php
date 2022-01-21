<?php

namespace Tests\Feature;

use Tests\TestCase;

class FrontEndTest extends TestCase
{
    public function test_article_viewer_html_is_returned()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSeeText('Fancy Article Viewer');
    }
}
