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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/albums/create', [App\Http\Controllers\AlbumController::class, 'create'])->name('album.create')->middleware('auth');
Route::get('/albums', [App\Http\Controllers\AlbumController::class, 'index'])->middleware('auth');
Route::get('/getalbums', [App\Http\Controllers\AlbumController::class, 'getAlbums'])->middleware('auth');
Route::post('/albums/store', [App\Http\Controllers\AlbumController::class, 'store'])->middleware('auth');

Route::put('/albums/{id}/update', [App\Http\Controllers\AlbumController::class, 'updateAlbum'])->middleware('auth');
Route::delete('/albums/delete/{id}', [App\Http\Controllers\AlbumController::class, 'deleteAlbum'])->middleware('auth');


Route::get('/create/image/{id}', [App\Http\Controllers\GalleryController::class, 'createImage'])->middleware('auth');

Route::post('/upload/image', [App\Http\Controllers\GalleryController::class, 'uploadImage'])->middleware('auth');
Route::get('/get/images', [App\Http\Controllers\GalleryController::class, 'getImages'])->middleware('auth');
Route::delete('/deleteImage/{id}', [App\Http\Controllers\GalleryController::class, 'deleteImage'])->middleware('auth');
Route::get('/albums/{slug}/{id}', [App\Http\Controllers\GalleryController::class, 'viewAlbumImages'])->name('album.image');

Route::get('/', [App\Http\Controllers\IndexController::class, 'index']);
Route::get('/userProfile/{id}', [App\Http\Controllers\IndexController::class, 'userAlbums'])->name('user.album');
Route::get('/category/{id}', [App\Http\Controllers\IndexController::class, 'userAlbumsByCategory'])->name('user.album.category');
Route::post('/follow', [App\Http\Controllers\FollowController::class, 'followAndUnfollow']);
route::get('/profile', [App\Http\Controllers\FollowController::class, 'profile'])->name('profile');

Route::get('/profilePic/{id}',[App\Http\Controllers\FollowController::class, 'userProfilePic'])->name('user.profile')->middleware('auth');
Route::post('/profilePic/update',[App\Http\Controllers\FollowController::class, 'userProfilePicUpdate'])->name('user.update.profile')->middleware('auth');
Route::get('/coverPic/{id}',[App\Http\Controllers\FollowController::class, 'userCoverPic'])->middleware('auth');
Route::post('/coverPic/update',[App\Http\Controllers\FollowController::class, 'userCoverPicUpdate'])->middleware('auth');

