<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/', [HomeController::class, 'showHome'])->name('home');

Route::get('/signup', [UserController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [UserController::class, 'handleSignup'])->name('signup');
Route::get('/verify-email/{hash}', [AuthController::class, 'verifyEmail'])->name('verify-email');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'handleLogin']);


Route::middleware('auth')->group(callback: function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'handleLogout'])->name('logout');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');

    // Temporary route for user.delete
    Route::delete('/users/{id}/destroy', function ($id) {
        return 'This is temporary route for user.delete, User ID: ' . $id;
    })->name('user.destroy');


    Route::get('/permission/{id}/edit', function ($id) {
        return 'This is temporary route for permission.edit, Permission ID: ' . $id;
    })->name('permissions.edit');

    Route::put('/permission/{id}/update', function ($id) {
        return 'This is temporary route for permission.update, Permission ID: ' . $id;
    })->name('permissions.update');

    Route::delete('/permission/{id}/destroy', function ($id) {
        return 'This is temporary route for permission.destroy, Permission ID: ' . $id;
    })->name('permissions.destroy');


    Route::get('/permission', [PermissionController::class, 'showPermissionForm'])->name('permission');
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions');
    Route::post('/permissions', [PermissionController::class, 'create'])->name('permissions.create');
});
