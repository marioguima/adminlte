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

Route::apiResource('campaigns', CampaignController::class)->names('api.campaigns');
Route::apiResource('groups', WaGroupController::class)->names('api.groups');
Route::apiResource('messages', MessageController::class)->names('api.messages');

Route::apiResource('redirect', RedirectionController::class)->names('api.redirect');
