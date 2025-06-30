<?php

use App\Http\Controllers\AjoutAgentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\AjoutAgentLocaController;
use App\Http\Controllers\AjoutVisiteurController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\AjoutLocaController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/Connexion', [ConnexionController::class, 'vue'])->name('vue');
Route::post('/Connexion', [ConnexionController::class, 'login'])->name('login');


//AGENT
Route::get('AjoutAgent', [AjoutAgentController::class, 'vue'])->name('vueAjoutAgent');
Route::post('AjoutAgent', [AjoutAgentController::class, 'storeAgent'])->name('storeAjoutAgent');
Route::get('/{id}/edit', [AjoutAgentController::class,])->name('edit');
Route::post('/{id}/edit', [AjoutAgentController::class, 'update']);




//Ajout de Location
Route::get('/AjoutLoca', [AjoutAgentLocaController::class, 'vue'])->name('vueAjoutLoca');
Route::post('/AjoutLoca', [AjoutAgentLocaController::class, 'storeAgentLoca'])->name('storeLoca');


//VISITEURS
Route::get('/AjoutVisiteur', [AjoutVisiteurController::class, 'vue'])->name('vueAjoutVisiteur');
Route::post('/AjoutVisiteur', [AjoutVisiteurController::class, 'storeVisiteur'])->name('storeAjoutVisiteur');






Route::get('/Statistique', [StatistiqueController::class, 'vue'])->name('vueStatistique');

Route::get('/AjoutAgentLoca', [AjoutLocaController::class, 'vue'])->name('vueAjoutAgentLoca');

Route::get('/Support', [SupportController::class, 'vue'])->name('vueSupport');

Route::get('/Dashboard', [DashboardController::class, 'vueDashboard'])->name('vueDashboard');
