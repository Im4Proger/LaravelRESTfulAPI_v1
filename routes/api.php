<?php

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

use App\Http\Controllers\Api\GoodController;
use App\Http\Controllers\Api\CategoryController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('good/index/good_name_like', [GoodController::class, 'goodNameLike']);
    Route::post('good/index/good_name_like_partial', [GoodController::class, 'goodNameLikePartial']);
    Route::post('good/index/category_id', [GoodController::class, 'categoryId']);
    Route::post('good/index/category_name_like', [GoodController::class, 'categoryNameLike']);
    Route::post('good/index/category_name_like_partial', [GoodController::class, 'categoryNameLikePartial']);
    Route::post('good/index/price', [GoodController::class, 'price']);
    Route::post('good/index/is_public', [GoodController::class, 'isPublic']);
    Route::post('good/index/deleted', [GoodController::class, 'deleted']);
    Route::post('good/create', [GoodController::class, 'store']);
    Route::put('good/edit', [GoodController::class, 'update']);
    Route::delete('good/delete', [GoodController::class, 'destroy']);
    Route::post('category/create', [CategoryController::class, 'store']);
    Route::delete('category/delete', [CategoryController::class, 'destroy']);
});
