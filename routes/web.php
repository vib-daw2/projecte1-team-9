<?php

use App\Http\Controllers\Admin\EditUserController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Blog\EditBlogController;
use App\Http\Controllers\Blog\LikeController;
use App\Http\Controllers\Blog\NewBlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Profiles\MyProfileController;
use App\Http\Controllers\Profiles\ProfileController;
use App\Http\Controllers\Profiles\ProfilePostsController;
use App\Http\Controllers\Profiles\ChangePasswordController;
use Illuminate\Support\Facades\Route;

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
Route::post('/login', [LoginController::class, 'login']);

Route::get('/signup', [SignupController::class, 'render']);
Route::post('/signup', [SignupController::class, 'signup']);

Route::post('/logout', [LogoutController::class, 'logout']);

Route::get('/blog/new', [NewBlogController::class, 'render']);
Route::post('/blog/new', [NewBlogController::class, 'create']);

Route::get('/blog/{id}', [BlogController::class, 'render']);

Route::get('/blog/{id}/edit', [EditBlogController::class, 'render']);
Route::post('/blog/{id}/edit', [EditBlogController::class, 'edit']);

Route::post('/blog/{id}/like', [LikeController::class, 'like']);

Route::get('/me', [MyProfileController::class, 'render']);
Route::post('/me', [MyProfileController::class, 'edit']);

Route::get('/me/posts', [ProfilePostsController::class, 'render']);
Route::get('/me/likes', [ProfilePostsController::class, 'render']);

Route::get('/me/password', [ChangePasswordController::class, 'render']);
Route::post('/me/password', [ChangePasswordController::class, 'changePassword']);

Route::get('/user/{id}', [ProfileController::class, 'render']);

Route::get('/admin/users', [UserController::class, 'render']);
Route::get('/admin/users/{id}', [EditUserController::class, 'render']);
Route::post('/admin/users/{id}/delete', [UserController::class, 'delete']);

Route::get('/admin/users/{id}/edit', [EditUserController::class, 'render']);
Route::post('/admin/users/{id}/edit', [EditUserController::class, 'edit']);
