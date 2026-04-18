<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\CandidatureController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', function () {
        return "Student Dashboard";
    });
});

Route::middleware(['auth', 'role:entreprise'])->group(function () {
    Route::get('/entreprise/dashboard', function () {
        return "Entreprise Dashboard";
    });
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return "Admin Dashboard";
    });
});

Route::middleware(['auth', 'role:entreprise'])->group(function () {
    Route::get('/entreprise/profile', [EntrepriseController::class, 'create']);
    Route::post('/entreprise/profile', [EntrepriseController::class, 'store']);
});

Route::middleware(['auth', 'role:entreprise'])->group(function () {
    Route::get('/offres/create', [OffreController::class, 'create']);
    Route::post('/offres', [OffreController::class, 'store']);
});

Route::get('/offres', [OffreController::class, 'index']);

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::post('/offres/{id}/apply', [CandidatureController::class, 'store']);
});

require __DIR__.'/auth.php';
