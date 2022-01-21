<?php

namespace App\Services;

use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

class HailService
{
    public function authenticate()
    {
        // throw new ServiceUnavailableHttpException();
    }

    public function getArticles(): array
    {
        return [
            ['id' => 1, 'title' => 'Article 1'],
            ['id' => 1, 'title' => 'Article 2'],
            ['id' => 1, 'title' => 'Article 3']
        ];
    }
}