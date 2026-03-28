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

Route::middleware(['auth', 'verified'])->group(function () {
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
