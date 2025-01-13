<?php

use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;


// Home page
Route::get('', [PublicController::class, 'index'])->name('/');

// Route::get('/', function () {
//     return view('frontend.index')->name('/');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
