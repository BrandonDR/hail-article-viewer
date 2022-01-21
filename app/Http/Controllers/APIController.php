<?php

namespace App\Http\Controllers;

use App\Services\HailService;
use Illuminate\Support\Facades\Cache;

class APIController extends Controller
{
    public function getArticles(HailService $hail)
    {
        if (Cache::has('hail_articles')) {
            info('using cache');
            return response()->json(Cache::get('hail_articles'));
        }

        $articles = HailService::getArticles();

        info('NOT using cache');
        Cache::put('hail_articles', $articles, now()->addMinutes(5));

        return response()->json($articles);
    }
}
