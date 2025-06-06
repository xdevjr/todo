<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RegisterController::class, 'index'])->name('register.index');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');

Route::resource('todos', TodoController::class);