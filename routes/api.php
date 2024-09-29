<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::namespace('Api')->name('api.')->group(function () {
    //不用认证的路由
    Route::namespace('Auth')->group(function () {
        Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
    });
    //需要认证的路由
    Route::middleware(['auth:sanctum'])->group(function () {
        //退出登录
        Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');
        //角色
        Route::post('/role', [RoleController::class, 'store'])->name('role.store');
        Route::get('/role', [RoleController::class, 'index'])->name('role.index');
        Route::get('/role/{role}', [RoleController::class, 'show'])->name('role.show');
        Route::put('/role/{role}', [RoleController::class, 'update'])->name('role.update');
        Route::delete('/role/{role}', [RoleController::class, 'destroy'])->name('role.destroy');
        //权限
        Route::post('/permission', [PermissionController::class, 'store'])->name('permission.store');
        Route::get('/permission', [PermissionController::class, 'index'])->name('permission.index');
        Route::delete('/permission/{permission}', [PermissionController::class, 'destroy'])->name('permission.destroy');
    });


});

