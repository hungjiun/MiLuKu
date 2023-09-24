<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestController;
use App\Http\Controllers\Page\Web\IndexController;
use App\Http\Controllers\Page\Web\AdminController;
use App\Http\Controllers\Page\Web\ProductController;
use App\Http\Controllers\Page\Web\ScenesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(
    [
        'prefix' => 'web',
    ], function() {
        Route::get( '', [IndexController::class, 'index'] );

        Route::get( 'projects', [TestController::class, 'index'] );
        Route::get( 'login', [IndexController::class, 'login'] );


        Route::get( 'index', [IndexController::class, 'index'] );

        Route::group(
            [
                'prefix' => 'admin',
            ], function () {
                Route::get( 'manager', [AdminController::class, 'manager'] );
            }
        );

        Route::group(
            [
                'prefix' => 'product',
            ], function () {
                Route::get( '', [ProductController::class, 'index'] );
                Route::get( 'index', [ProductController::class, 'index'] );
                Route::get( 'category', [ProductController::class, 'category'] );

            }
        );

        Route::group(
            [
                'prefix' => 'scenes',
            ], function () {
                Route::get( 'banner', [ScenesController::class, 'banner'] );
                Route::get( 'footer', [ScenesController::class, 'footer'] );

            }
        );
    }
);
