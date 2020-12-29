<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\AvatarUploadController;
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

// Pages/Home page
Route::get('/', [PageController::class, 'home'])->name('pages.home');

Route::get('/pages/{page}', [PageController::class, 'show'])->name('pages.show');

// Users
Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');

Route::post('/users/update/{user}', [UserController::class, 'update'])->name('users.update');

// Posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::post('/posts/{post}', [CommentController::class, 'store'])->name('comments.store');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');

Route::post('/posts/update/{post}', [PostController::class, 'update'])->name('posts.update');

Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// Edit/Delete Comments

Route::get('/comments/edit/{comment}', [CommentController::class, 'edit'])->name('comments.edit');

Route::post('/comments/update/{comment}', [CommentController::class, 'update'])->name('comments.update');

Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

// Upload avatar

Route::get('avatar-upload', [ AvatarUploadController::class, 'avatarUpload' ])->name('avatar.upload');

Route::post('avatar-upload', [ AvatarUploadController::class, 'avatarUploadPost' ])->name('avatar.upload.post');

// Upload for post images

Route::get('image-upload', [ ImageUploadController::class, 'imageUpload' ])->name('image.upload');

Route::post('image-upload', [ ImageUploadController::class, 'imageUploadPost' ])->name('image.upload.post');

// Auth
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
