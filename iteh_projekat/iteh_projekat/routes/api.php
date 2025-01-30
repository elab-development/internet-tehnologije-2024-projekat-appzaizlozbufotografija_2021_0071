<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KorisnikController;
use App\Http\Controllers\IzlozbaController;
use App\Http\Controllers\PrijavaController;
use App\Http\Controllers\GalerijaController;
use App\Http\Controllers\FotografijaController;
use App\Http\Controllers\UlogaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

// Rute za registraciju i login
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LogoutController::class, 'logout']);

// Rute za uloge koje mogu biti zaštićene na osnovu uloga korisnika
Route::middleware(['auth:sanctum', 'role:ADMINISTRATOR'])->group(function () {
    Route::post('/izlozbe', [IzlozbaController::class, 'store']);
    Route::put('/izlozbe/{id}', [IzlozbaController::class, 'update']);
    Route::delete('/izlozbe/{id}', [IzlozbaController::class, 'destroy']);
});

// Rute za umetnike
Route::middleware(['auth:sanctum', 'role:UMETNIK'])->group(function () {
    // Postavite rute koje samo umetnici mogu da pristupe
});

// Rute koje mogu koristiti korisnici sa različitim ulogama
Route::middleware(['auth:sanctum'])->group(function () {
    // Ove rute mogu koristiti svi autentifikovani korisnici
    Route::apiResource('korisnici', KorisnikController::class);
    Route::apiResource('izlozbe', IzlozbaController::class);
    Route::apiResource('prijave', PrijavaController::class);
    Route::apiResource('galerije', GalerijaController::class);
    Route::apiResource('fotografije', FotografijaController::class);
    Route::apiResource('uloge', UlogaController::class);  // Omogućeno za sve autentifikovane korisnike
});

// Test rutu
Route::get('/test', function () {
    return response()->json(['message' => 'API radi!']);
});

// Ruta za zaštitu određenih API-a
Route::middleware(['auth:sanctum', 'role:POSETILAC'])->group(function () {
    Route::get('/pozetilac', function () {
        return response()->json(['message' => 'Welcome, Visitor!']);
    });
});

Route::middleware(['auth:sanctum', 'role:UMETNIK'])->group(function () {
    Route::get('/umetnik', function () {
        return response()->json(['message' => 'Welcome, Artist!']);
    });
});
