<?php

use App\Http\Middleware\LocaleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FeedController;
use App\Http\Middleware\PostCreateMiddleware;
use App\Http\Middleware\PostEditMiddleware;
use Illuminate\Support\Facades\Redirect;

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

Route::get('locale/{locale}', function ($locale) {
    session(['locale' => $locale]);
    return Redirect::back();
})->name('locale');

Route::get('/feed', [FeedController::class, 'index'])->name('feed');

Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'login')->name('login.index');
    Route::post('/login', 'verify')->name('login.verify');
    Route::get('/register', 'register')->name('register.index');
    Route::post('/register', 'store')->name('register.store');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/profile/{username}', 'profile')->name('profile.index');
    Route::put('/profile/{username}', 'update')->name('profile.update');
});

Route::controller(PostController::class)->group(function () {
    Route::get('/posts', 'index')->name('posts.index');
});

Route::group(['middleware' => 'post.create'], function () { // Escritor - Editor - Admin
    Route::get('/posts/create', [PostController::class, 'storeForm'])->name('posts.form');
    Route::post('/posts/create', [PostController::class, 'store'])->name('posts.store');
});

Route::group(['middleware' => 'post.view'], function(){
    Route::get('/posts/{id}', [PostController::class ,'show'])->name('posts.show');
});

Route::group(['middleware' => 'post.edit'],function () { // Editor - Admin
    Route::get('/posts/edit/{id}', [PostController::class, 'showEditForm'])->name('posts.show.edit');
    Route::put('/posts/edit/update/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/delete/{id}', [PostController::class, 'delete'])->name('posts.delete');
});

Route::group(['middleware' => 'admin'], function () {
    Route::get('/manager', [AdminController::class, 'index'])->name('admin.index');
    Route::put('/manager/{username}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/manager/{username}', [AdminController::class, 'delete'])->name('admin.delete');
});

Route::get('/', function () {
    return redirect()->route('login.index');
});
