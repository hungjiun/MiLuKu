<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Portal\PortalController;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Portal Routes
|--------------------------------------------------------------------------
|
| Here is where you can register portal routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "portal" middleware group. Now create something great!
|
*/
Route::group([
    'middleware' => ['CheckLang']
], function () {
    Route::get('/', [PortalController::class, 'home'])->middleware('tpl');
    Route::get('/mail/{any?}', [PortalController::class, 'email']);
    Route::get('/html/{any?}', [PortalController::class, 'html'])->middleware('tpl');
    Route::get('/{any?}', [PortalController::class, 'html'])->middleware('tpl');
});
