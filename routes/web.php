<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PersonneController;
use App\Http\Controllers\UtilisateurController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::middleware('admin')->group(function () {
    //utilisateur
    Route::get('/user', [UtilisateurController::class, 'index'])->name('utilisateur.index');
    Route::get('/user/create', [UtilisateurController::class, 'create'])->name('utilisateur.create');
    Route::get('/user/edit/{id}', [UtilisateurController::class, 'edit'])->name('utilisateur.edit');
    //Route::get('/user/{id}', [UtilisateurController::class, 'show'])->name('utilisateur.show');
    Route::post('/user', [UtilisateurController::class, 'store'])->name('utilisateur.store');
    Route::patch('/user/{id}', [UtilisateurController::class, 'update'])->name('utilisateur.update');
    Route::delete('/user/{id}', [UtilisateurController::class, 'destroy'])->name('utilisateur.destroy');
});


//Personne
Route::get('/personne', [PersonneController::class, 'index'])->name('personne.index');
Route::get('/personne/create', [PersonneController::class, 'create'])->name('personne.create');
Route::get('/personne/edit/{id}', [PersonneController::class, 'edit'])->name('personne.edit');
Route::post('/personne', [PersonneController::class, 'store'])->name('personne.store');
Route::patch('/personne/{id}', [PersonneController::class, 'update'])->name('personne.update');
Route::delete('/personne/{id}', [PersonneController::class, 'destroy'])->name('personne.destroy');

//congé
Route::get('/conger', [CongeController::class, 'index'])->name('conger.index');
Route::get('/conger/create/{id}', [CongeController::class, 'create'])->name('conger.create');
Route::post('/conger', [CongeController::class, 'store'])->name('conger.store');


//generate Pdf
Route::get('/generate-pdf/{id}', [PdfController::class, 'generatePDF'])->middleware('auth')->name('pdfGen');
