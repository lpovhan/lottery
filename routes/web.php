<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('welcome');

Route::post('register', [AuthController::class, 'store'])->name('register');
Route::get('deactivate', [AuthController::class, 'deactivate'])->name('deactivate');

Route::get('/p/{link}', [ProfileController::class, 'view'])->name('dashboard');
Route::get('/new-link', [ProfileController::class, 'new_link'])->name('new-link');

Route::get('/game', [HistoryController::class, 'game'])->name('game');
Route::get('/last-games', [HistoryController::class, 'last_games'])->name('last-games');
