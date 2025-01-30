<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use Illuminate\Support\Facades\Route;


// Home page
Route::get('', [PublicController::class, 'index'])->name('/');

//ADMIN
Route::group(["prefix" => "admin", 'middleware' => ['auth:sanctum', config('jetstream.auth_session'),'check_suspended', 'has_any_admin_role'], "as" => 'admin.'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('manage-user', [ManageUserController::class, 'index'])->name('manage-user');
    Route::get('manage-user/create', [ManageUserController::class, 'create'])->name('manage-user.create');
    Route::get('manage-user/{user}/edit', [ManageUserController::class, 'edit'])->name('manage-user.edit');
    Route::delete('manage-user/{user}', [ManageUserController::class, 'destroy']);
    Route::get('manage-user/{user}/rest-password', [ManageUserController::class, 'resetPassword'])->name('manage-user.resetPassword');
    Route::post('manage-user/{user}/suspend', [ManageUserController::class, 'suspendUser']);
});


//USER
Route::group(["prefix" => "user", 'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'check_suspended','role:user'], "as" => 'user.'], function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});
