<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiPostController;
use App\Http\Controllers\ApiCommentController;
use Illuminate\Support\Facades\Auth;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// User routes
Route::post('login', [AuthController::class, 'apiLogin']);
Route::post('register', [AuthController::class, 'register']);

// Posts public routes
Route::get('posts', [ApiPostController::class, 'index']); // List all posts
Route::get('posts/{post}', [ApiPostController::class, 'show']); // View a specific post

// Middleware Auth routes
Route::middleware('auth:api')->group(function () {
    // Post auth routes
    Route::post('posts', [ApiPostController::class, 'store']); // Create a new post
    Route::put('posts/{post}', [ApiPostController::class, 'update']); // Update a post
    Route::delete('posts/{post}', [ApiPostController::class, 'destroy']); // Delete a post

    // Comment routes
    Route::post('posts/{post}/comments', [ApiCommentController::class, 'store']); // Add a comment to a post
    Route::put('comments/{comment}', [ApiCommentController::class, 'update']); // Update a comment
    Route::delete('comments/{comment}', [ApiCommentController::class, 'destroy']); // Delete a comment

});

