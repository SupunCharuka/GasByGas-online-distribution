<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GasRequestController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\OutletController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use Illuminate\Support\Facades\Route;


// Home page
Route::get('', [PublicController::class, 'index'])->name('/');

//ADMIN
Route::group(["prefix" => "admin", 'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'check_suspended', 'has_any_admin_role'], "as" => 'admin.'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //permission
    Route::get('permission', [PermissionController::class, 'index'])->name('permission');
    Route::get('permission/{permission}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::delete('permission/{permission}', [PermissionController::class, 'destroy']);

    //Role
    Route::get('role', [RoleController::class, 'index'])->name('role');
    Route::post('role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('role/{role}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('role/{role}',  [RoleController::class, 'update'])->name('role.update');
    Route::delete('role/{role}', [RoleController::class, 'destroy']);

    //Manage User
    Route::get('manage-user', [ManageUserController::class, 'index'])->name('manage-user');
    Route::get('manage-user/create', [ManageUserController::class, 'create'])->name('manage-user.create');
    Route::get('manage-user/{user}/edit', [ManageUserController::class, 'edit'])->name('manage-user.edit');
    Route::delete('manage-user/{user}', [ManageUserController::class, 'destroy']);
    Route::get('manage-user/{user}/rest-password', [ManageUserController::class, 'resetPassword'])->name('manage-user.resetPassword');
    Route::post('manage-user/{user}/suspend', [ManageUserController::class, 'suspendUser']);

    //outlet
    Route::get('outlet', [OutletController::class, 'index'])->name('outlet');
    Route::get('outlet/{outlet}/edit', [OutletController::class, 'edit'])->name('outlet.edit');
    Route::delete('outlet/{outlet}', [OutletController::class, 'destroy']);

    //Gas Request
    Route::middleware(['role:outlet-manager'])->group(function () {
        Route::get('gas-requests', [GasRequestController::class, 'index'])->name('gas-requests');
    });
    Route::post('gas-requests/update-status/{gasRequest}', [GasRequestController::class, 'updateStatus'])->name('gas-requests.update-status');
});


//USER
Route::group(["prefix" => "user", 'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'check_suspended', 'role:user'], "as" => 'user.'], function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    Route::get('gas-requests', [UserDashboardController::class, 'gasRequests'])->name('gas-requests');
    Route::post('gas-request/{gasRequest}/cancel', [UserDashboardController::class, 'cancelRequest'])->name('gas-requests.cancel');
});
