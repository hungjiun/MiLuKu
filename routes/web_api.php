<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Web\IndexController;
use App\Http\Controllers\API\Web\File\UploadController;
use App\Http\Controllers\API\Web\Admin\UserController;
use App\Http\Controllers\API\Web\Product\ProductController;
use App\Http\Controllers\API\Web\Product\CategoryController;

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
    ], function () {
        Route::post('login', [IndexController::class, 'userLogin']);

        Route::post('image', [UploadController::class, 'storeImage'])->name('storeImage');
        Route::post('video', [UploadController::class, 'storeVideo'])->name('storeVideo');

        Route::group(
            [
                'prefix' => 'admin'
            ], function () {
                Route::get('users', [UserController::class, 'getUsers']);
            }
        );

        Route::get('users', [UserController::class, 'getUsers']);

        Route::group(
            [
                'prefix' => 'product'
            ], function () {
                Route::get('search', [ProductController::class, 'getProducts']);

                Route::group(
                    [
                        'prefix' => 'category'
                    ], function () {
                        Route::get('search', [CategoryController::class, 'getCategories']);

                    }
                );
            }
        );

    }
);
