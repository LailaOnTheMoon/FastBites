<?php

use App\Http\Controllers\KitchenController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [TestController::class, 'viewTest'])->name('test');
Route::get('/updateUserTest', [TestController::class, 'updateUser'])->name('updateUserTest');
Route::get('/createUserTest', [TestController::class, 'createUser'])->name('createUserTest');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('kitchen')->name('kitchen.')->controller(KitchenController::class)->group(function () {
        Route::get('/', 'dashboard')->name('dashboard');
        Route::get('/board', 'board')->name('board');
        Route::get('/new-orders', 'newOrders')->name('new-orders');
        Route::get('/preparing-orders', 'preparingOrders')->name('preparing-orders');
        Route::get('/ready-orders', 'readyOrders')->name('ready-orders');
        Route::get('/completed-orders', 'completedOrders')->name('completed-orders');
    });

    Route::prefix('orders')->name('orders.')->controller(OrdersController::class)->group(function () {
        Route::get('/new', 'create')->name('create');
        Route::get('/preparation', 'preparation')->name('preparation');
        Route::get('/ready', 'ready')->name('ready');
    });

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
        Route::view('/manage-restaurants', 'admin.manage-restaurants')->name('manage-restaurants');
        Route::view('/orders', 'admin.orders')->name('orders');
        Route::view('/reports', 'admin.reports')->name('reports');
        Route::view('/settings', 'admin.settings')->name('settings');
    });

    Route::prefix('super-admin')->name('super-admin.')->group(function () {
        Route::view('/dashboard', 'super-admin.dashboard')->name('dashboard');
        Route::view('/manage-admins', 'super-admin.manage-admins')->name('manage-admins');
        Route::view('/manage-restaurants', 'super-admin.manage-restaurants')->name('manage-restaurants');
        Route::view('/user-management', 'super-admin.user-management')->name('user-management');
        Route::view('/system-reports', 'super-admin.system-reports')->name('system-reports');
        Route::view('/settings', 'super-admin.settings')->name('settings');
    });

    Route::prefix('user-management')->name('user-management.')->group(function () {
        Route::view('/dashboard', 'user-management.dashboard')->name('dashboard');
        Route::view('/all-users', 'user-management.all-users')->name('all-users');
        Route::view('/user-profiles', 'user-management.user-profiles')->name('user-profiles');
        Route::view('/user-reports', 'user-management.user-reports')->name('user-reports');
        Route::view('/settings', 'user-management.settings')->name('settings');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

require __DIR__.'/auth.php';
