<?php

use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API V1 Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [UserController::class, 'register'])->name('register');
Route::post('login', [UserController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::post('logout', [UserController::class, 'logout'])->name('logout');

    Route::resource('posts', PostController::class)->except(['create', 'edit']);
});
