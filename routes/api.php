<?php

use App\Http\Controllers\HelloController;
use App\Http\Controllers\PostController;
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

Route::middleware('auth:sanctum')->group(function(){
    //全ての投稿を取得(本番用)
    // Route::get('/posts', [PostController::class, 'index']);
    //投稿を作成
    Route::post('/posts', [PostController::class, 'store']);
    //投稿の詳細情報を取得
    Route::get('/posts/{post}', [PostController::class, 'show']);
    //投稿の編集
    Route::put('/posts/{post}', [PostController::class, 'update']);
    //投稿の削除
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
});

//全ての投稿を取得(テスト用)
Route::get('/posts', [PostController::class, 'index']);