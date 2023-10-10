<?php

use App\Http\Controllers\Admin\User\DeleteController as DeleteUserController;
use App\Http\Controllers\Admin\User\ReadController as ReadUsersController;
use App\Http\Controllers\Admin\User\UpdateController as UpdateUserController;
use App\Http\Controllers\Auth\External\GithubController;
use App\Http\Controllers\Auth\External\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Blog\DeleteController as DeleteBlogController;
use App\Http\Controllers\Blog\Interaction\Comment\DeleteController as DeleteCommentController;
use App\Http\Controllers\Blog\Interaction\Comment\NewController as NewCommentController;
use App\Http\Controllers\Blog\Interaction\LikeController;
use App\Http\Controllers\Blog\NewController as NewBlogController;
use App\Http\Controllers\Blog\ReadController as ReadBlogController;
use App\Http\Controllers\Blog\UpdateController as UpdateBlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Profile\Interaction\FollowController;
use App\Http\Controllers\Profile\Interaction\ReadController as ReadFollowsController;
use App\Http\Controllers\Profile\Mine\ReadController as ReadMyProfileController;
use App\Http\Controllers\Profile\Mine\ReadLikedController;
use App\Http\Controllers\Profile\Mine\UpdateController as UpdateMyProfileController;
use App\Http\Controllers\Profile\Mine\UpdatePasswordController;
use App\Http\Controllers\Profile\Mine\UpdateProfilePictureController;
use App\Http\Controllers\Profile\Post\ReadController as ReadPostsController;
use App\Http\Controllers\Profile\ReadController as ReadProfileController;
use App\Http\Controllers\SearchController;
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
Route::get('/search', [SearchController::class, 'search']); // Search view
Route::get('/blog', [HomeController::class, 'render']); // Home view
Route::get('/blog/new', [NewBlogController::class, 'render'])->middleware('auth'); // New blog view
Route::post('/blog/new', [NewBlogController::class, 'new'])->middleware('auth'); // New blog action
Route::get('/blog/{id}', [ReadBlogController::class, 'render']); // Blog view
Route::get('/blog/{id}/edit', [UpdateBlogController::class, 'render'])->middleware('auth'); // Edit blog view
Route::post('/blog/{id}/edit', [UpdateBlogController::class, 'edit'])->middleware('auth'); // Edit blog action
Route::post('/blog/{id}/delete', [DeleteBlogController::class, 'delete'])->middleware('auth'); // Delete blog action


/*
 * BLOGS INTERACTION
 *
 * All the routes that are related to the blogs interaction
 * */
Route::post('/blog/{id}/like', [LikeController::class, 'like'])->middleware('auth'); // Like/dislike blog action
Route::post('/blog/{id}/comment', [NewCommentController::class, 'comment'])->middleware('auth'); // Comment blog action
Route::post('/comment/{id}/delete', [DeleteCommentController::class, 'delete'])->middleware('auth'); // Delete comment action


/*
 * PROFILES
 *
 * All the routes that are related to the profiles
 * */
Route::get('/user/{id}', [ReadProfileController::class, 'render']); // Profile view
Route::get('/me', [ReadMyProfileController::class, 'render'])->middleware('auth'); // My profile view / Edit profile view
Route::get('/me/likes', [ReadLikedController::class, 'render'])->middleware('auth'); // View blogs that I liked
Route::get('/me/posts', [ReadPostsController::class, 'render'])->middleware('auth'); // View my posts
Route::get('/me/following', [ReadFollowsController::class, 'render'])->middleware('auth'); // View users that I follow
Route::post('/follow/{id}', [FollowController::class, 'follow'])->middleware('auth'); // Follow/unfollow a user action


/*
 * EDIT PROFILE
 *
 * All the routes that are related to the profile editing
 * Change password, edit profile, delete profile
 * */
Route::post('/me', [UpdateMyProfileController::class, 'edit'])->middleware('auth'); // Edit profile action
Route::get('/me/password', [UpdatePasswordController::class, 'render'])->middleware('auth'); // Change password view
Route::post('/me/password', [UpdatePasswordController::class, 'changePassword'])->middleware('auth'); // Change password action
Route::post('/me/profilepicture', [UpdateProfilePictureController::class, 'change'])->middleware('auth'); // Change profile picture action


/*
 * ADMIN PANEL
 *
 * All the routes that are related to the admin panel
 * */
Route::get('/admin/users', [ReadUsersController::class, 'render']); // List all users
Route::post('/admin/users/{id}/delete', [DeleteUserController::class, 'delete']); // Delete a user action
Route::get('/admin/users/{id}/edit', [UpdateUserController::class, 'render']); // Edit a user view
Route::post('/admin/users/{id}/edit', [UpdateUserController::class, 'edit']); // Edit a user action
