<?php

use App\Http\Controllers\Admin\User\Login\ViewController as LoginViewController;
use App\Http\Controllers\Admin\User\Login\AuthenticateController as AdminAuthenticateController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\User\LogoutController as AdminLogoutController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::prefix('user')->name('user.')->group(function () {
            Route::prefix('login')->name('login.')->group(function () {
                Route::get('/', [LoginViewController::class, '__invoke'])->name('view');
                Route::post('/', [AdminAuthenticateController::class, '__invoke'])->name('authenticate');
            });
        });
    });
    Route::middleware('auth:admin')->group(function () {
        Route::get('/', [AdminDashboardController::class, '__invoke'])->name('home');
        Route::prefix('user')->name('user.')->group(function () {
            Route::post('logout', [AdminLogoutController::class, '__invoke'])->name('logout');
        });
    });
});