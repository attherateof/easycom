<?php

use App\Http\Controllers\Admin\User\Login\ViewController as LoginViewController;
use App\Http\Controllers\Admin\User\Login\AuthenticateController as AdminAuthenticateController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\User\LogoutController as AdminLogoutController;
// Customer
use App\Http\Controllers\Admin\Customer\ListController as CustomerListController;
use App\Http\Controllers\Admin\Customer\AddController as CustomerAddController;
use App\Http\Controllers\Admin\Customer\EditController as CustomerEditController;
use App\Http\Controllers\Admin\Customer\SaveController as CustomerSaveController;
use App\Http\Controllers\Admin\Customer\DeleteController as CustomerDeleteController;
// Category
use App\Http\Controllers\Admin\Catalog\Category\CreateController as CatalogCategoryCreateController;
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
        Route::prefix('customer')->name('customer.')->group(function () {
            Route::get('list', [CustomerListController::class, '__invoke'])->name('list');
            Route::get('add', [CustomerAddController::class, '__invoke'])->name('add');
            Route::get('edit/{id}', [CustomerEditController::class, '__invoke'])->name('edit');
            Route::post('save', [CustomerSaveController::class, '__invoke'])->name('save');
            Route::delete('delete', [CustomerDeleteController::class, '__invoke'])->name('delete');
        });
        Route::prefix('catalog')->name('catalog.')->group(function () {
            Route::prefix('category')->name('category.')->group(function () {
                Route::get('create', [CatalogCategoryCreateController::class, '__invoke'])->name('create');
            });
        });
    });
});