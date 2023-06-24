<?php

use App\Http\Controllers\Api\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Broadcast::routes(['middleware' => ['auth:sanctum']]);

Route::get("/sources", [ArticleController::class, "get_sources"])
    ->name("articles.get_sources");

Route::middleware(['auth:sanctum'])->group(function() {
    Route::post("/search/params", [ArticleController::class, "search_params"])
        ->name("articles.search_params");
    Route::post("/search", [ArticleController::class, "search"])
        ->name("articles.search");
});

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
