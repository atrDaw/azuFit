<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClaseController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\ReservaController;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('signup', [AuthController::class, 'signupForm'])->name('signupForm');
Route::post('signup', [AuthController::class, 'signup'])->name('signup');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


route::get('/clases', [ClaseController::class, 'index'])->name('clases.index');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard')->name('dashboard');
    });
    
    Route::get('/clases/{id}', [ClaseController::class, 'show'])->name('clases.show');
    Route::get('/clases/create', [ClaseController::class, 'create'])->name('clases.create');
    Route::post('/clases', [ClaseController::class, 'store'])->name('clases.store');
    route::get('/clases/{id}/edit', [ClaseController::class, 'edit'])->name('clases.edit');
    route::put('/clases/{id}', [ClaseController::class, 'update'])->name('clases.update');
    route::delete('/clases/{id}/destroy', [ClaseController::class, 'destroy'])->name('clases.destroy');

    Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
    Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');
    Route::delete('/reservas/{id}/destroy', [ReservaController::class, 'destroy'])->name('reservas.destroy');
    
    Route::get('/sesiones', [SesionController::class, 'index'])->name('sesiones.index');
    Route::get('/sesiones/create', [SesionController::class, 'create'])->name('sesiones.create');
    Route::get('/sesiones/{id}/edit', [SesionController::class, 'edit'])->name('sesiones.edit');
    Route::put('/sesiones/{id}', [SesionController::class, 'update'])->name('sesiones.update');
    Route::post('/sesiones', [SesionController::class, 'store'])->name('sesiones.store');
});
