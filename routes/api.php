<?php

use App\Http\Controllers\api\CampaignController;
use App\Http\Controllers\api\CampaignsController;
use App\Http\Controllers\api\MessageController;
use App\Http\Controllers\api\RedirectionController;
use App\Http\Controllers\api\WaGroupController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('campanhas', CampaignController::class)->names('api.campaigns')->parameters(['campanhas' => 'campaign']);
Route::apiResource('grupos', WaGroupController::class)->names('api.groups')->parameters(['grupos' => 'group']);
Route::apiResource('mensagens', MessageController::class)->names('api.messages')->parameters(['mensagens' => 'message']);

Route::apiResource('redirecionar', RedirectionController::class)->names('api.redirect')->parameters(['redirecionar' => 'redirect']);
