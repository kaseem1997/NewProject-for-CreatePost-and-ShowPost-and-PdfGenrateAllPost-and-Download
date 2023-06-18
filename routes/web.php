<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');


Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');

Route::get('/posts/create', [PostsController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');

Route::post('/comments', [CommentsController::class, 'store'])->name('comments.store');

Route::post('/posts/likes/{pid}', [PostsController::class, 'likes'])->name('posts.likes');
Route::post('/posts/dislike/{pid}', [PostsController::class, 'dislike'])->name('posts.dislike');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/pdfDownload', [PostsController::class, 'pdfDownload'])->name('pdf.download');

});


