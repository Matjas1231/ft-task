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
