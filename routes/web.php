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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/albums/create', [App\Http\Controllers\AlbumController::class, 'create'])->name('album.create')->middleware('auth');
Route::get('/albums', [App\Http\Controllers\AlbumController::class, 'index'])->middleware('auth');
Route::get('/getalbums', [App\Http\Controllers\AlbumController::class, 'getAlbums'])->middleware('auth');
Route::post('/albums/store', [App\Http\Controllers\AlbumController::class, 'store'])->middleware('auth');

Route::put('/albums/{id}/update', [App\Http\Controllers\AlbumController::class, 'updateAlbum'])->middleware('auth');
Route::delete('/albums/delete/{id}', [App\Http\Controllers\AlbumController::class, 'deleteAlbum'])->middleware('auth');

