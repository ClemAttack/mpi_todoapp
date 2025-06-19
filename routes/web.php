<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

// Route d'accueil
Route::get('/', function () {
    return redirect()->route('todos.index');
});

// Routes pour les todos (protégées par authentification)
Route::middleware(['auth'])->group(function () {
    Route::resource('todos', TodoController::class);
    Route::patch('todos/{todo}/toggle', [TodoController::class, 'toggle'])->name('todos.toggle');
});

// Routes d'authentification (si vous utilisez Laravel Breeze ou similaire)
require __DIR__.'/auth.php';
