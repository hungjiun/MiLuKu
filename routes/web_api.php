<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Web\IndexController;
use App\Http\Controllers\API\Web\Admin\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(
    [
        'as' => 'web_api.',
    ], function() {
        Route::post('login', [IndexController::class, 'userLogin']);

        Route::get('get_users', [UserController::class, 'getUsers']);

    }
);
