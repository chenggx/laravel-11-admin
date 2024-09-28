<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::namespace('Api')->name('api.')->group(function () {
    Route::namespace('Auth')->group(function () {
        Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
    });

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/role', [RoleController::class, 'store'])->name('role.store');
        Route::get('/role', [RoleController::class, 'index'])->name('role.index');
        Route::get('/role/{role}', [RoleController::class, 'show'])->name('role.show');
        Route::put('/role/{role}', [RoleController::class, 'update'])->name('role.update');
        Route::delete('/role/{role}', [RoleController::class, 'destroy'])->name('role.destroy');
    });


});

