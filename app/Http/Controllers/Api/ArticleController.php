<?php

namespace App\Http\Controllers\Api;

use App\Events\CallApiArticlesEvent;
use App\Http\Controllers\Controller;
use App\Models\Source;
use App\Services\NewsApi\Service as NewsApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
//    public function search(Request $request, NewsApiService $news_api_service): \Illuminate\Http\JsonResponse
    public function search(Request $request): JsonResponse
    {
        CallApiArticlesEvent::dispatch($request->only("keyword"));

        return response()->json(["status" => true, "data" => ["success"]]);
    }

//    public function get_sources(NewsApiService $news_api_service)
//    {
//        $sources = $news_api_service->sources();
//        foreach ($sources as $source) {
//            Source::create($source->toArray());
//        }
//    }

    public function search_params(NewsApiService $news_api_service): JsonResponse
    {
        $categories = $news_api_service->categories();
        $all_sources = Source::all();
        $sources = [];
        foreach($all_sources as $source)
            $sources[] = ["value" => $source->source_id, "label" => ucfirst($source->name)];

        return response()->json(["status" => true, "data" => ["sources" => $sources, "categories" => $categories]]);
    }

}
