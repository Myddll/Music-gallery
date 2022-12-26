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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/artist/{text}', [\App\Http\Controllers\API\LastFmController::class, 'getArtist'])->name('api.last-fm.get-info-about-artist');
Route::get('/artist/{text}/description', [\App\Http\Controllers\API\LastFmController::class, 'getDescription'])->name('api.last-fm.get-description-about-artist');
Route::get('/{album}/{artist}/cover', [\App\Http\Controllers\API\LastFmController::class, 'getAlbum'])->name('api.last-fm.get-cover-by-album-and-artist');
Route::get('/{key}/{text}/search', [\App\Http\Controllers\API\LastFmController::class, 'search'])->name('api.last-fm.search-by-artist-or-album');
