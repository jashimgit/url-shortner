<?php


use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;


// create group route with namespace

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::group(['prefix' => '/link'], function () {
        Route::get('/create', [DashboardController::class, 'create']);
        Route::post('/create', [DashboardController::class, 'store']);
        Route::get('/report/{linkHash}', [DashboardController::class, 'report']);
        Route::get('/delete/{linkHash}', [DashboardController::class, 'delete']);
    });
});


