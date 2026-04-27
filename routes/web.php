<?php

use App\Http\Controllers\KitchenController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\CustomerDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\SuperAdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [TestController::class, 'viewTest'])->name('test');
Route::get('/updateUserTest', [TestController::class, 'updateUser'])->name('updateUserTest');
Route::get('/createUserTest', [TestController::class, 'createUser'])->name('createUserTest');

Route::middleware(['auth:web,customer'])->group(function () {
    Route::get('/dashboard', CustomerDashboardController::class)->name('dashboard');

    // ================== Profile ==================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth:web'])->group(function () {

    // ================== Kitchen ==================
    Route::prefix('kitchen')
    ->name('kitchen.')
    ->middleware('role:kitchen_manager')
    ->controller(KitchenController::class)
    ->group(function () {
        Route::get('/', 'dashboard')->name('dashboard');
        Route::get('/new-orders', 'newOrders')->name('new-orders');
        Route::get('/preparing-orders', 'preparingOrders')->name('preparing-orders');
        Route::get('/ready-orders', 'readyOrders')->name('ready-orders');
        Route::get('/completed-orders', 'completedOrders')->name('completed-orders');
    });
    
    // ================== Orders ==================
    Route::prefix('orders')
        ->name('orders.')
        ->middleware('role:admin,super_admin')
        ->controller(OrdersController::class)
        ->group(function () {
            Route::get('/new', 'create')->name('create');
            Route::get('/preparation', 'preparation')->name('preparation');
            Route::get('/ready', 'ready')->name('ready');
        });

    // ================== Settings ==================
    Route::get('/settings', [SettingsController::class, 'index'])
        ->middleware('role:admin,super_admin,user_manager')
        ->name('settings.index');

    // ================== ADMIN ==================
    Route::prefix('admin')
    ->name('admin.')
    ->middleware('role:admin')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::get('/manage-restaurants', [AdminController::class, 'manageRestaurants'])->name('manage-restaurants');

        Route::get('/orders', function () {
            return view('admin.orders');
        })->name('orders');

        Route::get('/reports', [AdminController::class, 'reports'])->name('reports');

        Route::get('/settings', function () {
            return view('admin.settings');
        })->name('settings');

        Route::get('/manage-employees', [EmployeeController::class, 'index'])->name('employees');
        Route::get('/create-employee', [EmployeeController::class, 'create'])->name('employees.create');
        Route::post('/store-employee', [EmployeeController::class, 'store'])->name('employees.store');
        Route::get('/edit-employee/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::post('/update-employee/{id}', [EmployeeController::class, 'update'])->name('employees.update');
        Route::delete('/delete-employee/{id}', [EmployeeController::class, 'destroy'])->name('employees.delete');
        Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
        });


    // ================== SUPER ADMIN ==================
    Route::prefix('super-admin')
    ->name('super-admin.')
    ->middleware('role:super_admin')
    ->group(function () {
        Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/manage-admins', [SuperAdminController::class, 'manageAdmins'])->name('manage-admins');
        Route::get('/manage-restaurants', [SuperAdminController::class, 'manageRestaurants'])->name('manage-restaurants');
        Route::get('/user-management', [SuperAdminController::class, 'userManagement'])->name('user-management');
        Route::get('/system-reports', [SuperAdminController::class, 'systemReports'])->name('system-reports');
        Route::view('/settings', 'super-admin.settings')->name('settings');
    });

    // ================== USER MANAGEMENT ==================
    Route::prefix('user-management')
        ->name('user-management.')
        ->middleware('role:user_manager')
        ->group(function () {
            Route::get('/dashboard', [UserManagementController::class, 'dashboard'])->name('dashboard');
            Route::get('/all-users', [UserManagementController::class, 'allUsers'])->name('all-users');
            Route::get('/edit-user/{id}', [UserManagementController::class, 'edit'])->name('edit-user');
            Route::put('/update-user/{id}', [UserManagementController::class, 'update'])->name('update-user');
            Route::delete('/delete-user/{id}', [UserManagementController::class, 'destroy'])->name('delete-user');
            Route::get('/user-profiles', [UserManagementController::class, 'userProfiles'])->name('user-profiles');
            Route::get('/user-reports', [UserManagementController::class, 'userReports'])->name('user-reports');
            Route::view('/settings', 'user-management.settings')->name('settings');
        });
});

// ================== AUTH ==================
require __DIR__.'/auth.php';
