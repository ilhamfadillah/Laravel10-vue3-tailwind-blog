<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/admin/blog', [BlogController::class, 'getBlog']);
    Route::post('/admin/blog', [BlogController::class, 'createBlog']);
    Route::get('/admin/blog/{id}', [BlogController::class, 'showBlog']);
    Route::put('/admin/blog/{id}', [BlogController::class, 'updateBlog']);
    Route::put('/admin/blog/{id}/publish', [BlogController::class, 'publishBlog']);
    Route::delete('/admin/blog/{id}', [BlogController::class, 'deleteBlog']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::resource('/blog', BlogController::class);
Route::post('/blog/search', [BlogController::class, 'search']);
