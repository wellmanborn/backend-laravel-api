<?php

namespace App\Http\Controllers\Api;

use App\Events\CallApiArticlesEvent;
use App\Http\Controllers\Controller;
use App\Models\DataSource;
use App\Models\Source;
use App\Services\NYTimes\Service;
use App\Services\ServiceContext;
use App\Services\NewsApi\Service as NewsApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
//    public function search(Request $request, NewsApiService $news_api_service): \Illuminate\Http\JsonResponse
    public function search(Request $request)
    {
        CallApiArticlesEvent::dispatch($request->get("keyword"), $request->get("data_source"), $request->get("resource"),
            $request->get("category"), $request->get("published_at"), auth()->user());

        return response()->json(["status" => true, "data" => ["success"]]);
    }

    public function search_params(NewsApiService $news_api_service): JsonResponse
    {
        $categories = $news_api_service->categories();
        $all_sources = Source::all();
        $sources = [];
        foreach ($all_sources as $source)
            $sources[] = ["value" => $source->source_id, "label" => ucfirst($source->name)];

        return response()->json(["status" => true, "data" => ["sources" => $sources, "categories" => $categories]]);
    }

    public function categories(Request $request): JsonResponse
    {
        $serviceContext = new ServiceContext();
        $service = $serviceContext->get_service($request->get("data_source"));
        return response()->json(["status" => true, "data" => $service->categories()]);
    }

    public function sources(Request $request): JsonResponse
    {
        $serviceContext = new ServiceContext();
        $service = $serviceContext->get_service($request->get("data_source"));
        $sources = $service->sources();
        $response = [];
        foreach ($sources as $key => $value) {
            $response[] = ["value" => $key, "label" => ucfirst($value)];
        }
        return response()->json(["status" => true, "data" => $response]);
    }

    public function data_sources(): JsonResponse
    {
        $allDataSources = DataSource::all();
        $dataSources = [];
        foreach ($allDataSources as $source) {
            $dataSources[] = ["value" => $source->slug , "label" => ucfirst($source->name)];
        }
        return response()->json(["status" => true, "data" => $dataSources]);
    }

}
