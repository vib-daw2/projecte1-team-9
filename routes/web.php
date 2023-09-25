<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewBlogController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\ProfilePostsController;
use App\Http\Controllers\EditBlogController;

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

Route::get('/', [HomeController::class, 'render']);
Route::get('/login', [LoginController::class, 'render']);

Route::get('/signup', [SignupController::class, 'render']);
Route::post('/signup', [SignupController::class, 'signup']);

Route::get('/blog/new', [NewBlogController::class, 'render']);
Route::get('/blog/{id}', [BlogController::class, 'render']);
Route::get('/blog/{id}/edit', [EditBlogController::class, 'render']);
Route::get('/me', [MyProfileController::class, 'render']);
Route::get('/me/posts', [ProfilePostsController::class, 'render']);
Route::get('/me/likes', [ProfilePostsController::class, 'render']);
