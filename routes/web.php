<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SegmentationController;
use App\Http\Controllers\WaGroupController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\Home\HomeController::class, 'index'])->name('home');
Route::get('/painel', [App\Http\Controllers\Panel\PanelController::class, 'index'])->name('panel.index');

Route::resource('/painel/campanhas', CampaignController::class)->names('campaigns')->parameters(['campanhas' => 'campaign']);
Route::resource('/painel/segmentacoes', SegmentationController::class)->names('segmentations')->parameters(['segmentacoes' => 'segmentation']);
Route::resource('/painel/grupos', WaGroupController::class)->names('groups')->parameters(['grupos' => 'group']);
Route::resource('/painel/mensagens', MessageController::class)->names('messages')->parameters(['mensagens' => 'message']);

// Usado via ajax para popular select
Route::get('/painel/grupos/segmentacoes/{campaign}', [WaGroupController::class, 'getSegmentations'])->name('groups.segmentations.fetch');

Auth::routes();