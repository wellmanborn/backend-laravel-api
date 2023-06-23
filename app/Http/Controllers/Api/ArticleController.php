<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\NewsApi\Service as NewsApiService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function search(Request $request, NewsApiService $news_api_service): \Illuminate\Http\JsonResponse
    {
        $collection = $news_api_service->search($request->get("keyword") ?? "barak obama",
            $request->get("resource"),
            $request->get("published_at"));

        return response()->json(["status" => true, "data" => $collection]);
    }
}
