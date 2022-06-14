<?php

use App\Http\Controllers\Api\CandidateController;
use App\Http\Controllers\Api\CommentController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')
    ->name('api.')
    ->group(function () {
        Route::apiResource('candidates', CandidateController::class)->except('update');
        Route::post('candidates/{candidate}', [CandidateController::class, 'update'])->name('candidates.update');

        Route::apiResource('comments', CommentController::class)->except('index', 'show');
    });
