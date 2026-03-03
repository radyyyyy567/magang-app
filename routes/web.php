<?php

use App\Http\Controllers\CareerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

// Guest Career Pages
Route::get('/career', [CareerController::class, 'index'])->name('career.index');
Route::get('/career/{id}', [CareerController::class, 'show'])->name('career.show');

use App\Http\Controllers\CandidateRegistrationController;

Route::get('/register-intern', [CandidateRegistrationController::class, 'index'])->name('candidate.register');
Route::post('/register-intern', [CandidateRegistrationController::class, 'store'])->name('candidate.store');
