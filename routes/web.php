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
use App\Http\Controllers\Profile\ChangePasswordController;
use App\Http\Controllers\Profile\MyLikesController;
use App\Http\Controllers\Profile\MyProfileController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Profile\ProfilePostsController;
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

Route::get('/', [HomeController::class, 'render']); // Home view

/*
 * AUTHENTICATION
 *
 * All the routes that are related to the authentication
 * Login, signup, logout
 * */
Route::get('/login', [LoginController::class, 'render']); // Login view
Route::post('/login', [LoginController::class, 'login']); // Login action
Route::get('/signup', [SignupController::class, 'render']); // Signup view
Route::post('/signup', [SignupController::class, 'signup']); // Signup action
Route::post('/logout', [LogoutController::class, 'logout']); // Logout action


/*
 * BLOGS
 *
 * All the routes that are related to the blogs
 * */
Route::get('/blog/{id}', [BlogController::class, 'render']); // Blog view
Route::get('/blog/new', [NewBlogController::class, 'render']); // New blog view
Route::post('/blog/new', [NewBlogController::class, 'create']); // New blog action
Route::get('/blog/{id}/edit', [EditBlogController::class, 'render']); // Edit blog view
Route::post('/blog/{id}/edit', [EditBlogController::class, 'edit']); // Edit blog action
Route::post('/blog/{id}/like', [LikeController::class, 'like']); // Like/dislike blog action


/*
 * PROFILES
 *
 * All the routes that are related to the profiles
 * */
Route::get('/user/{id}', [ProfileController::class, 'render']); // Profile view
Route::get('/me', [MyProfileController::class, 'render']); // My profile view / Edit profile view
Route::get('/me/likes', [MyLikesController::class, 'render']); // View blogs that I liked
Route::get('/me/posts', [ProfilePostsController::class, 'render']); // View my posts

/*
 * EDIT PROFILE
 *
 * All the routes that are related to the profile editing
 * Change password, edit profile, delete profile
 * */
Route::post('/me', [MyProfileController::class, 'edit']); // Edit profile
Route::get('/me/password', [ChangePasswordController::class, 'render']); // Change password view
Route::post('/me/password', [ChangePasswordController::class, 'changePassword']); // Change password action


/*
 * ADMIN PANEL
 *
 * All the routes that are related to the admin panel
 * */
Route::get('/admin/users', [UserController::class, 'render']); // List all users
Route::post('/admin/users/{id}/delete', [UserController::class, 'delete']); // Delete a user action
Route::get('/admin/users/{id}/edit', [EditUserController::class, 'render']); // Edit a user view
Route::post('/admin/users/{id}/edit', [EditUserController::class, 'edit']); // Edit a user action
