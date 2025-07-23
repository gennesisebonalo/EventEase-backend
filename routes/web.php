<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [DashboardController::class, 'index']);

Route::resource('admin/events', EventController::class);
