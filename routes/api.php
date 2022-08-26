<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('product', [ProductController::class, 'index']);
Route::get('product/show/{id}', [ProductController::class, 'show']);
Route::get('product/destroy/{id}', [ProductController::class, 'destroy']);
Route::post('product/store', [ProductController::class, 'store']);
Route::post('product/update/{id}', [ProductController::class, 'update']);

