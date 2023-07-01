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
    public function search(Request $request): JsonResponse
    {

        $ny_times = app(Service::class);

        $ny_times->search($request->get("keyword"), null, $request->get("category"));

        dd("here");

        CallApiArticlesEvent::dispatch($request->get("keyword"), $request->get("category"),
            $request->get("published_at"), $request->get("resource"), auth()->user());

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

    public function sources(): JsonResponse
    {
        $dataSources = DataSource::all();

        $response = [];
        foreach ($dataSources as $dataSource) {
            $serviceContext = new ServiceContext();
            $service = $serviceContext->get_service($dataSource->slug);
            $sources = $service->sources();
            $tmp = [];
            foreach ($sources as $key => $value) {
                $tmp[] = ["value" => $dataSource->slug . "|" . $key, "label" => ucfirst($dataSource->name . " -> " . $value)];
            }
            $response = array_merge($response, $tmp);
        }
        return response()->json(["status" => true, "data" => $response]);
    }

}
