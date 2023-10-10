<?php

use App\Http\Controllers\Admin\EditUserController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\External\GithubController;
use App\Http\Controllers\Auth\External\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Blog\DeleteController;
use App\Http\Controllers\Blog\EditBlogController;
use App\Http\Controllers\Blog\Interaction\Comment\CommentController;
use App\Http\Controllers\Blog\Interaction\LikeController;
use App\Http\Controllers\Blog\NewBlogController;
use App\Http\Controllers\Blog\ReadBlogController;
use App\Http\Controllers\Blog\SearchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Profile\ChangePasswordController;
use App\Http\Controllers\Profile\ChangeProfilePictureController;
use App\Http\Controllers\Profile\FollowController;
use App\Http\Controllers\Profile\FollowingController;
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

Route::get('/', function () {
    return View('landing');
}); // Home view


/*
 * AUTHENTICATION
 *
 * All the routes that are related to the authentication
 * Login, signup, logout
 * */
Route::get('/login', [LoginController::class, 'render'])->name("login"); // Login view
Route::post('/login', [LoginController::class, 'login']); // Login action
Route::get('/signup', [SignupController::class, 'render']); // Signup view
Route::post('/signup', [SignupController::class, 'signup']); // Signup action
Route::post('/logout', [LogoutController::class, 'logout']); // Logout action

// Socialite external auth providers
Route::get('/auth/github', [GithubController::class, 'provider']);
Route::get('/auth/github/callback', [GithubController::class, 'callback']);
Route::get('/auth/google', [GoogleController::class, 'provider']);
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);


/*
 * BLOGS
 *
 * All the routes that are related to the blogs
 * */
Route::get('/blog', [HomeController::class, 'render']); // Home view
Route::get('/blog/new', [NewBlogController::class, 'render'])->middleware('auth'); // New blog view
Route::post('/blog/new', [NewBlogController::class, 'new'])->middleware('auth'); // New blog action
Route::get('/search', [SearchController::class, 'search']); // Search view
Route::get('/blog/{id}', [ReadBlogController::class, 'render']); // Blog view
Route::get('/blog/{id}/edit', [EditBlogController::class, 'render'])->middleware('auth'); // Edit blog view
Route::post('/blog/{id}/edit', [EditBlogController::class, 'edit'])->middleware('auth'); // Edit blog action
Route::post('/blog/{id}/delete', [DeleteController::class, 'delete'])->middleware('auth'); // Delete blog action


/*
 * BLOGS INTERACTION
 *
 * All the routes that are related to the blogs interaction
 * */
Route::post('/blog/{id}/like', [LikeController::class, 'like'])->middleware('auth'); // Like/dislike blog action
Route::post('/blog/{id}/comment', [CommentController::class, 'comment'])->middleware('auth'); // Comment blog action
Route::post('/blog/{id}/comment/delete', [CommentController::class, 'delete'])->middleware('auth'); // Delete comment action
Route::get('/blog/{id}/comments', [CommentController::class, 'getComments']); // Get comments action


/*
 * PROFILES
 *
 * All the routes that are related to the profiles
 * */
Route::get('/user/{id}', [ProfileController::class, 'render']); // Profile view
Route::get('/me', [MyProfileController::class, 'render'])->middleware('auth'); // My profile view / Edit profile view
Route::get('/me/likes', [MyLikesController::class, 'render'])->middleware('auth'); // View blogs that I liked
Route::get('/me/posts', [ProfilePostsController::class, 'render'])->middleware('auth'); // View my posts
Route::get('/me/following', [FollowingController::class, 'render'])->middleware('auth'); // View users that I follow
Route::post('/follow/{id}', [FollowController::class, 'follow'])->middleware('auth'); // Follow/unfollow a user action


/*
 * EDIT PROFILE
 *
 * All the routes that are related to the profile editing
 * Change password, edit profile, delete profile
 * */
Route::post('/me', [MyProfileController::class, 'edit'])->middleware('auth'); // Edit profile action
Route::get('/me/password', [ChangePasswordController::class, 'render'])->middleware('auth'); // Change password view
Route::post('/me/password', [ChangePasswordController::class, 'changePassword'])->middleware('auth'); // Change password action
Route::post('/me/profilepicture', [ChangeProfilePictureController::class, 'change'])->middleware('auth'); // Change profile picture action


/*
 * ADMIN PANEL
 *
 * All the routes that are related to the admin panel
 * */
Route::get('/admin/users', [UserController::class, 'render']); // List all users
Route::post('/admin/users/{id}/delete', [UserController::class, 'delete']); // Delete a user action
Route::get('/admin/users/{id}/edit', [EditUserController::class, 'render']); // Edit a user view
Route::post('/admin/users/{id}/edit', [EditUserController::class, 'edit']); // Edit a user action
