<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index', ['posts' => Post::all()]);
})->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/detail/{slug}', [PageController::class, 'detail'])->name('post.detail');

Route::resource('/post', PostController::class);
Route::resource('/comment', CommentController::class);
Route::resource('/gallery', GalleryController::class);

Route::middleware('auth')->group(function () {
    Route::get('/change-password', [HomeController::class, 'editPassword'])->name('password.edit');
    Route::post('/update-password', [HomeController::class, 'updatePassword'])->name('update-password');

    Route::get('/edit-profile', [HomeController::class, 'editProfile'])->name('edit-profile');
    Route::post('/edit-profile', [HomeController::class, 'updateProfile'])->name('update-profile');
});
