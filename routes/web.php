<?php

use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\ProfileController;
use App\Models\Candidature;
use App\Models\Offre;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    // Show global website statistics for the admin.
    if ($user->role === 'admin') {
        $stats = [
            'users' => User::count(),
            'students' => User::where('role', 'student')->count(),
            'entreprises' => User::where('role', 'entreprise')->count(),
            'offers' => Offre::count(),
            'applications' => Candidature::count(),
            'accepted' => Candidature::where('status', 'accepted')->count(),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $recentOffers = Offre::with('entreprise')->latest()->take(5)->get();
        $recentCandidatures = Candidature::with(['user', 'offre'])->latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentUsers', 'recentOffers', 'recentCandidatures'));
    }

    // Show simple entreprise data on the dashboard.
    if ($user->role === 'entreprise') {
        $entrepriseId = optional($user->entreprise)->id;

        $recentCandidatures = Candidature::with(['user', 'offre'])
            ->whereHas('offre', function ($query) use ($entrepriseId) {
                $query->where('entreprise_id', $entrepriseId);
            })
            ->latest()
            ->take(5)
            ->get();

        $stats = [
            'offers' => Offre::where('entreprise_id', $entrepriseId)->count(),
            'applications' => Candidature::whereHas('offre', function ($query) use ($entrepriseId) {
                $query->where('entreprise_id', $entrepriseId);
            })->count(),
            'pending' => Candidature::where('status', 'pending')->whereHas('offre', function ($query) use ($entrepriseId) {
                $query->where('entreprise_id', $entrepriseId);
            })->count(),
            'accepted' => Candidature::where('status', 'accepted')->whereHas('offre', function ($query) use ($entrepriseId) {
                $query->where('entreprise_id', $entrepriseId);
            })->count(),
        ];

        return view('dashboard', compact('stats', 'recentCandidatures'));
    }

    // Show simple student data on the dashboard.
    $offres = Offre::latest()->take(5)->get();
    $candidatures = Candidature::with('offre')
        ->where('user_id', $user->id)
        ->latest()
        ->take(5)
        ->get();

    return view('dashboard', compact('offres', 'candidatures'));
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', function () {
        return redirect()->route('dashboard');
    });

    // Show the current student's applications.
    Route::get('/mes-candidatures', [CandidatureController::class, 'studentIndex'])->name('student.applications');
    // Store a new application for an offer.
    Route::post('/offres/{id}/apply', [CandidatureController::class, 'store'])->name('candidatures.store');
});

Route::middleware(['auth', 'role:entreprise'])->group(function () {
    Route::get('/entreprise/dashboard', function () {
        return redirect()->route('dashboard');
    });

    // Create a simple entreprise profile.
    Route::get('/entreprise/profile', [EntrepriseController::class, 'create'])->name('entreprise.create');
    Route::post('/entreprise/profile', [EntrepriseController::class, 'store'])->name('entreprise.store');

    // Create and store offers.
    Route::get('/offres/create', [OffreController::class, 'create'])->name('offres.create');
    Route::post('/offres', [OffreController::class, 'store'])->name('offres.store');

    // Review and update received applications.
    Route::get('/entreprise/candidatures', [CandidatureController::class, 'index'])->name('entreprise.candidatures.index');
    Route::get('/entreprise/candidatures/{id}/cv', [CandidatureController::class, 'showCv'])->name('entreprise.candidatures.cv');
    Route::post('/candidatures/{id}/accept', [CandidatureController::class, 'accept'])->name('candidatures.accept');
    Route::post('/candidatures/{id}/refuse', [CandidatureController::class, 'refuse'])->name('candidatures.refuse');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return redirect()->route('dashboard');
    })->name('admin.dashboard');
});

// Show the offers list for connected users.
Route::middleware('auth')->get('/offres', [OffreController::class, 'index'])->name('offres.index');

require __DIR__.'/auth.php';
