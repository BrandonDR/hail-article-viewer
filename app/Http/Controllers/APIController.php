<?php

namespace App\Http\Controllers;

use App\Services\HailService;

class APIController extends Controller
{
    public function getArticles(HailService $hail)
    {
        $hail->authenticate();
        $articles = $hail->getArticles();

        return response()->json($articles);
    }
}
