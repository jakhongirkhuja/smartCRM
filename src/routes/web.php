<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\WidgetController;

use Illuminate\Support\Facades\Route;


Route::get('/', [IndexController::class, 'index']);
Route::get('widget', [WidgetController::class, 'index']);

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginPost'])->name('loginPost');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('admin')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::get('', [AdminController::class, 'admin'])->name('admin');
        Route::get('statistics', [AdminController::class, 'statistics'])->name('statistics');
    });
    Route::middleware('role:admin|manager')->group(function () {
        Route::get('tickets', [AdminController::class, 'tickets'])->name('tickets');
        Route::get('tickets/{id}', [AdminController::class, 'ticketEach'])->name('ticketEach');
        Route::post('tickets/{ticket}/status', [AdminController::class, 'ticketStatus'])->name('ticketStatus');
    });
});
