<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AcademieController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\JoueurController;
use App\Http\Controllers\RecruteurController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Pages publiques
Route::get('/', [AccueilController::class, 'index'])->name('accueil');
Route::get('/explorer', [RecruteurController::class, 'explorer'])->name('explorer');
Route::get('/recherche', [RecruteurController::class, 'recherche'])->name('recherche');
Route::get('/joueur/{id}', [JoueurController::class, 'showPublic'])->name('joueur.public')->whereNumber('id');
Route::get('/joueur/{id}/rapport', [JoueurController::class, 'rapport'])->name('joueur.rapport')->whereNumber('id');
Route::get('/academie/{id}', [AcademieController::class, 'showPublic'])->name('academie.public')->whereNumber('id');

// Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout']); // fallback GET

Route::get('/register/academie', [AuthController::class, 'registerAcademie'])->name('register.academie');
Route::post('/register/academie', [AuthController::class, 'storeAcademie'])->name('register.academie.store');

Route::get('/register/recruteur', [AuthController::class, 'registerRecruteur'])->name('register.recruteur');
Route::post('/register/recruteur', [AuthController::class, 'storeRecruteur'])->name('register.recruteur.store');

Route::get('/register/joueur', [AuthController::class, 'registerJoueur'])->name('register.joueur');
Route::post('/register/joueur', [AuthController::class, 'storeJoueur'])->name('register.joueur.store');

// Dashboard Academie
Route::middleware('auth')->prefix('academie')->name('academie.')->group(function () {
    Route::get('/dashboard', [AcademieController::class, 'dashboard'])->name('dashboard');
    Route::get('/coachs', [AcademieController::class, 'coachs'])->name('coachs');
    Route::get('/coachs/create', [AcademieController::class, 'createCoach'])->name('coachs.create');
    Route::post('/coachs/store', [AcademieController::class, 'storeCoach'])->name('coachs.store');
    Route::get('/coachs/{id}/edit', [AcademieController::class, 'editCoach'])->name('coachs.edit');
    Route::post('/coachs/{id}/update', [AcademieController::class, 'updateCoach'])->name('coachs.update');
    Route::delete('/coachs/{id}', [AcademieController::class, 'deleteCoach'])->name('coachs.delete');
    Route::get('/joueurs', [AcademieController::class, 'joueurs'])->name('joueurs');
    Route::get('/profil', [AcademieController::class, 'profil'])->name('profil');
    Route::post('/profil/update', [AcademieController::class, 'updateProfil'])->name('profil.update');
});

// Dashboard Coach
Route::middleware('auth')->prefix('coach')->name('coach.')->group(function () {
    Route::get('/dashboard', [CoachController::class, 'dashboard'])->name('dashboard');
    Route::get('/joueurs', [CoachController::class, 'mesJoueurs'])->name('joueurs');
    Route::get('/joueurs/create', [CoachController::class, 'createJoueur'])->name('joueurs.create');
    Route::post('/joueurs/store', [CoachController::class, 'storeJoueur'])->name('joueurs.store');
    Route::get('/joueurs/{id}/edit', [CoachController::class, 'editJoueur'])->name('joueurs.edit');
    Route::post('/joueurs/{id}/update', [CoachController::class, 'updateJoueur'])->name('joueurs.update');
    Route::get('/evaluations/create/{joueur_id}', [CoachController::class, 'createEvaluation'])->name('evaluations.create');
    Route::post('/evaluations/store/{joueur_id}', [CoachController::class, 'storeEvaluation'])->name('evaluations.store');
    Route::get('/validations', [CoachController::class, 'validations'])->name('validations');
    Route::post('/joueurs/{id}/validate', [CoachController::class, 'validateJoueur'])->name('joueurs.validate');
    Route::post('/joueurs/{id}/reject', [CoachController::class, 'rejectJoueur'])->name('joueurs.reject');
});

// Dashboard Joueur
Route::middleware('auth')->prefix('joueur')->name('joueur.')->group(function () {
    Route::get('/dashboard', [JoueurController::class, 'dashboard'])->name('dashboard');
    Route::get('/profil', [JoueurController::class, 'profil'])->name('profil');
    Route::get('/profil/edit', [JoueurController::class, 'editProfil'])->name('profil.edit');
    Route::post('/profil/update', [JoueurController::class, 'updateProfil'])->name('profil.update');
    Route::get('/videos', [JoueurController::class, 'videos'])->name('videos');
    Route::get('/videos/create', [JoueurController::class, 'createVideo'])->name('videos.create');
    Route::post('/videos/store', [JoueurController::class, 'storeVideo'])->name('videos.store');
    Route::get('/stats', [JoueurController::class, 'stats'])->name('stats');
});

Route::post('/onboarding/complete', function() {
    auth()->user()->update(['has_onboarded' => true]);
    return response()->json(['success' => true]);
})->middleware('auth')->name('onboarding.complete');

// Dashboard Recruteur
Route::middleware('auth')->prefix('recruteur')->name('recruteur.')->group(function () {
    Route::get('/dashboard', [RecruteurController::class, 'dashboard'])->name('dashboard');
    Route::get('/favoris', [RecruteurController::class, 'favoris'])->name('favoris');
    Route::post('/favoris/{id}/toggle', [RecruteurController::class, 'toggleFavoris'])->name('favoris.toggle');
    Route::get('/messages', [RecruteurController::class, 'messages'])->name('messages');
});

// Messagerie Unifiée (Tous les rôles)
Route::middleware('auth')->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{otherUserId}', [MessageController::class, 'show'])->name('messages.show')->whereNumber('otherUserId');
    Route::post('/messages/store', [MessageController::class, 'store'])->name('messages.store');
});

// Redirection pour le recruteur si nécessaire
Route::get('/recruteur/messages', [MessageController::class, 'index'])->name('recruteur.messages');
Route::post('/recruteur/messages/envoyer', [MessageController::class, 'store'])->name('recruteur.messages.store');

// Profil partagé
Route::middleware('auth')->group(function () {
    Route::post('/profile/update-photos', [ProfileController::class, 'updatePhotos'])->name('profile.update-photos');
});

// Pages statiques & Légales
Route::get('/a-propos', [App\Http\Controllers\PageController::class, 'aPropos'])->name('pages.a-propos');
Route::get('/cgu', [App\Http\Controllers\PageController::class, 'cgu'])->name('pages.cgu');
Route::get('/mentions-legales', [App\Http\Controllers\PageController::class, 'mentionsLegales'])->name('pages.mentions-legales');
Route::get('/politique-confidentialite', [App\Http\Controllers\PageController::class, 'confidentialite'])->name('pages.politique-confidentialite');
Route::get('/carrieres', [App\Http\Controllers\PageController::class, 'carrieres'])->name('pages.carrieres');
Route::get('/blog', [App\Http\Controllers\PageController::class, 'blog'])->name('pages.blog');
Route::get('/partenaires', [App\Http\Controllers\PageController::class, 'partenaires'])->name('pages.partenaires');
Route::get('/annuaire-academies', [App\Http\Controllers\PageController::class, 'annuaire'])->name('pages.annuaire');
Route::get('/methodologie', [App\Http\Controllers\PageController::class, 'methodologie'])->name('pages.methodologie');
Route::get('/tarifs-recruteurs', [App\Http\Controllers\PageController::class, 'tarifs'])->name('pages.tarifs');

