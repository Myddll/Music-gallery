<?php

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

Route::get('/', [\App\Http\Controllers\MainController::class, 'homePage'])->name('home');
Route::get('/search/{artist}', [\App\Http\Controllers\MainController::class, 'searchAlbumsByArtist'])->name('search-albums-by-artist');
Route::get('/search', [\App\Http\Controllers\MainController::class, 'findArtists'])->name('find-artists-by-name');
Route::get('/artists', [\App\Http\Controllers\MainController::class, 'artistsPage'])->name('all-artists');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'loginForm'])->name('auth.login-form');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'loginProcess'])->name('auth.login-process');

    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'registerForm'])->name('auth.register-form');
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'registerProcess'])->name('auth.register-process');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('album', \App\Http\Controllers\Album\AlbumController::class)->only(['create', 'store', 'update', 'edit', 'destroy']);

    Route::resource('artist', \App\Http\Controllers\Artist\ArtistController::class)->only(['create', 'store', 'update', 'edit', 'destroy']);

    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');
});
