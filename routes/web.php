<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\SegmentationController;
use App\Models\WaGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\Home\HomeController::class, 'index'])->name('home.index');
Route::get('/painel', [App\Http\Controllers\Panel\PanelController::class, 'show'])->name('panel.show');
// Route::get('/panel/campaigns', [App\Http\Controllers\Panel\PanelController::class, 'index'])->name('panel.campaigns.index');

Route::resource('/painel/campanhas', CampaignController::class)->names('campaigns')->parameters(['campanhas' => 'campaign']);
Route::resource('/painel/segmentacoes', SegmentationController::class)->names('segmentations')->parameters(['segmentacoes' => 'segmentation']);
Route::resource('/painel/grupos', WaGroup::class)->names('groups')->parameters(['grupos' => 'group']);