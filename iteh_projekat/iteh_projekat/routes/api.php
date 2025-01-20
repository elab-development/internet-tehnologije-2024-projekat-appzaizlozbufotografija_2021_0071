<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KorisnikController;
use App\Http\Controllers\IzlozbaController;
use App\Http\Controllers\PrijavaController;
use App\Http\Controllers\GalerijaController;
use App\Http\Controllers\FotografijaController;
use App\Http\Controllers\UlogaController;

/*
|----------------------------------------------------------------------
| API Routes
|----------------------------------------------------------------------
| Here is where you can register API routes for your application.
| Routes are loaded by the RouteServiceProvider within a group
| assigned the "api" middleware group.
| Enjoy building your API!
|----------------------------------------------------------------------
*/

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
