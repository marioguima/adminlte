<?php

use App\Http\Controllers\CampaignController;
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
Route::get('/panel', [App\Http\Controllers\Panel\PanelController::class, 'index'])->name('panel.index');
// Route::get('/panel/campaigns', [App\Http\Controllers\Panel\PanelController::class, 'index'])->name('panel.campaigns.index');

Route::resource('campanhas', CampaignController::class)->names('campaign')->parameters(['campanhas' => 'campaign']);
