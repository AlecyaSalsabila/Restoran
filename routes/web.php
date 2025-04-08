<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MyOrderController;

Route::get('', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::resource('myorders', MyOrderController::class);
Route::resource('menus', MenuController::class);
Route::resource('reports', ReportController::class);
Route::resource('orders', OrderController::class);
Route::patch('orders/{order}/confirm', [OrderController::class, 'confirmOrder'])->name('orders.confirmOrder');
Route::get('reports/export', [ReportController::class, 'export'])->name('reports.export');  
Route::get('reports/show', [ReportController::class, 'show'])->name('reports.show');  



