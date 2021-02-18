<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

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

// Home
Route::get('/', [App\Http\Controllers\ArticleController::class, 'index'])->name('index');

// 記事
Route::resource('article', ArticleController::class);

// コメント
Route::resource('comment', CommentController::class, ['only' => ['store', 'destroy']]);

// ユーザー
Auth::routes();
