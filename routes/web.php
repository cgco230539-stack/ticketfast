<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;

Route::get('/', function(){
    return view('home');
})->name('home');

// Rutas públicas de auth
Route::get('/registro', [AuthController::class, 'registerForm'])->name('registro');
Route::post('/registro', [AuthController::class, 'register'])->name('registro.store');
Route::get('/acceso', [AuthController::class, 'loginForm'])->name('acceso');
Route::post('/acceso', [AuthController::class, 'login'])->name('acceso.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas por sesión
Route::middleware('session')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('events', EventController::class);
    Route::resource('tickets', TicketController::class);
    Route::get('/admin/tickets', [TicketController::class, 'adminIndex'])
        ->name('tickets.admin');
});

// Rutas solo para admin
Route::middleware(['session', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/create', [UserController::class, 'createAdmin'])->name('admin.create');
    Route::post('/admin/store', [UserController::class, 'storeAdmin'])->name('admin.store');
    Route::get('/admins', [UserController::class, 'admins'])->name('admins.index');
});

Route::get('/api-events', [EventController::class, 'apiEvents'])
    ->name('events.api');