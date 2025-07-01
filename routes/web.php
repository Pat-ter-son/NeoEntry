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
use App\Http\Controllers\AdminController;
use App\Models\AjoutAgentModel;

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
Route::delete('/deleteAjoutAgent/{id}', [AjoutAgentController::class, 'delete'])->name('deleteAjoutAgent');


//Ajout de Locataire
Route::get('/AjoutLoca', [AjoutAgentLocaController::class, 'vue'])->name('vueAjoutLoca');
Route::post('/AjoutLoca', [AjoutLocaController::class, 'store'])->name('storeAjoutLoca');
Route::delete('/AjoutLoca/{id}', [AjoutLocaController::class, 'delete'])->name('deleteAjoutLoca');


//VISITEURS
Route::get('/AjoutVisiteur', [AjoutVisiteurController::class, 'vue'])->name('vueAjoutVisiteur');
Route::post('/AjoutVisiteur', [AjoutVisiteurController::class, 'storeVisiteur'])->name('storeAjoutVisiteur');







//Ajout Agent&Locataire
Route::get('/AjoutAgentLoca', [AjoutLocaController::class, 'vue'])->name('vueAjoutAgentLoca');
Route::post('/AjoutAgentLoca', [AjoutAgentLocaController::class, 'store'])->name('storeAjoutAgentLoca');


Route::get('/Support', [SupportController::class, 'vue'])->name('vueSupport');

//Dashboard
Route::get('/Dashboard', [DashboardController::class, 'vueDashboard'])->name('vueDashboard');



//ADMIN
Route::get('/Admin', [AdminController::class, 'vue'])->name('vueAdmin');
Route::post('/Admin', [AdminController::class, 'login'])->name('loginAdmin');
