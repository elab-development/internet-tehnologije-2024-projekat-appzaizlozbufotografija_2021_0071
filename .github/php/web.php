<?php

use App\Http\Controllers\PrijavaController;
use App\Http\Controllers\IzlozbaController;
use App\Http\Controllers\KorisnikController;
use App\Http\Controllers\GalerijaController;
use App\Http\Controllers\FotografijaController;
use App\Http\Controllers\UlogaController;

// Web rute (ako želite da zadržite početnu rutu)
Route::get('/', function () {
    return view('welcome');
});

// API rute
Route::apiResource('prijave', PrijavaController::class);
Route::apiResource('izlozbe', IzlozbaController::class);
Route::apiResource('korisnici', KorisnikController::class);
Route::apiResource('galerije', GalerijaController::class);
Route::apiResource('fotografije', FotografijaController::class);
Route::apiResource('uloge', UlogaController::class);
