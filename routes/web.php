<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\SegmentationController;
use App\Models\WaGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\Home\HomeController::class, 'index'])->name('home');
Route::get('/painel', [App\Http\Controllers\Panel\PanelController::class, 'index'])->name('panel.index');

Route::resource('/painel/campanhas', CampaignController::class)->names('campaigns')->parameters(['campanhas' => 'campaign']);
Route::resource('/painel/segmentacoes', SegmentationController::class)->names('segmentations')->parameters(['segmentacoes' => 'segmentation']);
Route::resource('/painel/grupos', WaGroup::class)->names('groups')->parameters(['grupos' => 'group']);

Auth::routes();