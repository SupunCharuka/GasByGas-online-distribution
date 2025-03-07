<?php

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GasRequestController;
use App\Http\Controllers\Admin\ManageBusinessController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\OutletController;
use App\Http\Controllers\Admin\OutletStockRequestController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TokenController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\User\BusinessController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use Illuminate\Support\Facades\Route;


// Home page
Route::get('', [PublicController::class, 'index'])->name('/');
Route::get('/about-us', [PublicController::class, 'aboutUs'])->name('aboutUs');
Route::get('/branches', [PublicController::class, 'branches'])->name('branches');
Route::get('/contact-us', [PublicController::class, 'contactUs'])->name('contactUs');

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
        Route::get('gas-requests/tokens/{gasRequest}', [TokenController::class, 'showToken'])->name('tokens.show');
        Route::post('gas-requests/tokens/{token}/mark-used', [TokenController::class, 'markUsed'])->name('tokens.markUsed');
        Route::post('gas-requests/tokens/{token}/reallocate', [TokenController::class, 'reallocate'])->name('tokens.reallocate');

        Route::get('outlet/stock-request', [OutletStockRequestController::class, 'index'])->name('outlet-stock-request');
    });

    Route::post('gas-requests/update-status/{gasRequest}', [GasRequestController::class, 'updateStatus'])->name('gas-requests.update-status');

    Route::get('tokens', [TokenController::class, 'index'])->name('tokens');

    Route::get('outlet-stock-requests', [OutletStockRequestController::class, 'adminIndex'])->name('stock-request.adminIndex');
    Route::post('outlet-stock-requests/{outletStockRequest}/complete', [OutletStockRequestController::class, 'complete'])->name('outlet-stock-requests.complete');
    Route::post('outlet-stock-requests/{outletStockRequest}/approve', [OutletStockRequestController::class, 'approve'])->name('outlet-stock-requests.approve');
    Route::post('outlet-stock-requests/{outletStockRequest}/reject', [OutletStockRequestController::class, 'reject'])->name('outlet-stock-requests.reject');
    Route::get('outlet/stock-request/{stockRequest}/edit', [OutletStockRequestController::class, 'edit'])->name('outlet-stock-request.edit');

    Route::get('manage-business', [ManageBusinessController::class, 'index'])->name('manage-business');
    Route::get('manage-business/{business}/edit', [ManageBusinessController::class, 'edit'])->name('manage-business.edit');
    Route::put('manage-business/{business}/update', [ManageBusinessController::class, 'update'])->name('manage-business.update');
    Route::get('manage-business/details/{id}', [ManageBusinessController::class, 'show'])->name('manage-business.show');
    Route::post('manage-business/{id}/approve', [ManageBusinessController::class, 'approve'])->name('manage-business.approve');
    Route::post('manage-business/{id}/reject', [ManageBusinessController::class, 'reject'])->name('manage-business.reject');

    Route::get('contact-us', [ContactController::class, 'index'])->name('contact-us');
});


//USER
Route::group(["prefix" => "user", 'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'check_suspended', 'role:user|business', 'business_approved'], "as" => 'user.'], function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    Route::get('my-gas-requests', [UserDashboardController::class, 'gasRequests'])->name('gas-requests');
    Route::post('gas-request/{gasRequest}/cancel', [UserDashboardController::class, 'cancelRequest'])->name('gas-requests.cancel');
    Route::get('gas-requests/token/{gasRequest}', [UserDashboardController::class, 'getToken']);
});

Route::middleware(['auth:sanctum', 'check_suspended', 'role:business'])->group(function () {
    Route::get('user/update-business', [BusinessController::class, 'edit'])->name('user.update-business');
    Route::post('user/update-business', [BusinessController::class, 'update'])->name('user.update-business.save');
});
