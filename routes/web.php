<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AuthController;

Route::get('/', function(){
    return view('home');
})->name('home');

Route::middleware('session')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('tickets', TicketController::class);
});

// Ruta para regresar la vista del registro
Route::get('/registro', [
    AuthController::class, 'registerForm'
])->name('registro');

// Ruta para guardar el registro de usuario
Route::post('/registro', [
    AuthController::class, 'register'
])->name('registro.store');

Route::get('/acceso', [
    AuthController::class, 'loginForm'
])->name('acceso');

// Ruta para iniciar sesión
Route::post('/acceso', [
    AuthController::class, 'login'
])->name('acceso.store');

// Ruta para cerrar sesión
Route::post('/logout', [
    AuthController::class, 'logout'
])->name('logout');

Route::middleware(['session', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/create', [UserController::class, 'createAdmin'])->name('admin.create');
    Route::post('/admin/store', [UserController::class, 'storeAdmin'])->name('admin.store');

    Route::get('/admins', [UserController::class, 'admins'])->name('admins.index');
});