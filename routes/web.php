<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResetPasswordController;
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

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::group([
    'middleware' => 'can:editor-level'
], function () {
    // ROUTES FOR POSTS MANAGEMENT
    Route::get('/panel', [PanelController::class, 'index'])->name('panel.index');
    Route::get('/panel/posts/create', [PostController::class, 'create'])->name('panel.post.create');
    Route::post('/panel/posts/create', [PostController::class, 'store'])->name('panel.post.store');

    Route::get('/panel/posts/{postId}', [PostController::class, 'show'])->name('panel.post.show');
    Route::get('/panel/posts/{postId}/edit', [PostController::class, 'edit'])->name('panel.post.edit');
    Route::post('/panel/posts/edit', [PostController::class, 'update'])->name('panel.post.update');

    Route::get('/panel/posts/{postId}/delete', [PostController::class, 'delete'])->name('panel.post.delete');

    // ROUTES FOR USERS MANAGEMENT
    Route::group([
        'middleware' => 'can:admin-level'
    ], function () {
        Route::get('/panel/users', [PanelController::class, 'usersList'])->name('panel.user.list');

        Route::get('/panel/users/create', [UserController::class, 'create'])->name('panel.user.create');
        Route::post('/panel/users/create', [UserController::class, 'store'])->name('panel.user.store');


        Route::get('/panel/users/{userId}/edit', [UserController::class, 'edit'])->name('panel.user.edit');
        Route::post('/panel/users/edit', [UserController::class, 'update'])->name('panel.user.update');

        Route::get('panel/users/{userId}/delete', [UserController::class, 'delete'])->name('panel.user.delete');
    });
});

// ROUTES FOR AUTH
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'logging'])->name('logging');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registration'])->name('registration');

// ROUTES FOR RESETTING PASSWORD
Route::group([
    'middleware' => ['guest']
], function () {
    Route::get('forget-password', [ResetPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [ResetPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');

    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ResetPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
});
