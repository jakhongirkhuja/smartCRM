<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\WidgetController;
use Illuminate\Support\Facades\Route;


Route::get('/', [IndexController::class, 'index']);
Route::get('/widget', [WidgetController::class, 'index']);
