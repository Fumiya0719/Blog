<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CatGenController;
use App\Http\Controllers\RecentPostController;
use App\Http\Controllers\SearchArticlesController;
use App\Http\Controllers\SitemapController;

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

// Authorization
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// トップページ
Route::get('/', [RecentPostController::class, 'index'])->name('/');

// 記事投稿関連
// laravel8ではControllerのクラスをuseする必要あり
Route::prefix('articles/')->middleware('auth')->group(function () {
    // 記事編集関連
    Route::get('index', [ArticleController::class, 'index'])->name('articles/index');

    Route::get('create', [ArticleController::class, 'create'])->name('articles/create');
    Route::get('create', [ArticleController::class, 'showGenres'])->name('articles/create');

    Route::post('store', [ArticleController::class, 'store'])->name('articles/store');

    Route::get('edit/{id}', [ArticleController::class, 'edit'])->name('articles/edit');
    // Route::get('edit/{id}', [ArticleController::class, 'editGenres'])->name('articles/edit');

    Route::post('update/{id}', [ArticleController::class, 'update'])->name('articles/update');

    Route::post('destroy/{id}', [ArticleController::class, 'destroy'])->name('articles/destroy');
});
// 記事表示関連
Route::get('show/{id}', [ArticleController::class, 'show'])->name('show');

// 記事検索関連
Route::get('search/index', [SearchArticlesController::class, 'index'])->name('search/index');

// サイトマップ関連
// Route::get('sitemap/', [SitemapController::class, 'index'])->name('sitemap/');


// ckeditorの画像アップロード用
Route::post('ckeditor/images', 'UploadImageController@upload')->name('ckeditor/images');

// カテゴリ・ジャンル関連
Route::prefix('cg/')->middleware('auth')->group(function () {
    Route::get('index', [CatGenController::class, 'index'])->name('cg/index');
    Route::get('create', [CatGenController::class, 'create'])->name('cg/create');
    Route::post('store', [CatGenController::class, 'store'])->name('cg/store');
    Route::post('store', [CatGenController::class, 'store'])->name('cg/store');
    // Route::get('edit/{id}', [CatGenController::class, 'edit'])->name('cg/edit');
    // Route::post('update/{id}', [CatGenController::class, 'update'])->name('cg/update');
    Route::post('destroy/{id}', [CatGenController::class, 'destroy'])->name('cg/destroy');
});


