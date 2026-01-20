<?php

use App\Http\Controllers\CareerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Guest Career Pages
Route::get('/career', [CareerController::class, 'index'])->name('career.index');
Route::get('/career/{id}', [CareerController::class, 'show'])->name('career.show');
