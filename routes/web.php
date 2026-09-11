<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\TodoController;

Route::get('/', [TodoController::class, 'index'])->name('todos.index');
Route::get('/todos/create', [TodoController::class, 'create'])->name('todos.create');
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
Route::patch('/todos/{id}/status', [TodoController::class, 'updateStatus'])->name('todos.updateStatus');
Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');