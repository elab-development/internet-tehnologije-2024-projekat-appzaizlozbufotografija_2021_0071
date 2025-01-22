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


Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LogoutController::class, 'logout']);








// Rute za Korisnik
Route::apiResource('korisnici', KorisnikController::class); // Korišćenje apiResource za sve CRUD rute za korisnike

// Rute za Izlozbe
Route::apiResource('izlozbe', IzlozbaController::class); // Korišćenje apiResource za sve CRUD rute za izložbe

// Rute za Prijave
Route::apiResource('prijave', PrijavaController::class); // Korišćenje apiResource za sve CRUD rute za prijave

// Rute za Galerije
Route::apiResource('galerije', GalerijaController::class); // Korišćenje apiResource za sve CRUD rute za galerije

// Rute za Fotografije
Route::apiResource('fotografije', FotografijaController::class); // Korišćenje apiResource za sve CRUD rute za fotografije

// Rute za Uloge
Route::apiResource('uloge', UlogaController::class); // Korišćenje apiResource za sve CRUD rute za uloge

// Test rutu
Route::get('/test', function () {
    return response()->json(['message' => 'API radi!']);

});

Route::middleware('auth')->group(function () {
    Route::post('/izlozbe', [IzlozbaController::class, 'store']);
    Route::put('/izlozbe/{id}', [IzlozbaController::class, 'update']);
    Route::delete('/izlozbe/{id}', [IzlozbaController::class, 'destroy']);
});



