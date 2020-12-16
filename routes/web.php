<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
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

// Pages
Route::get('/pages', [PageController::class, 'index'])->name('pages.store');

Route::get('/pages/{page}', [PageController::class, 'show'])->name('pages.show');

// Users
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');




//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/user', function () {
//    return "Hello";
//});