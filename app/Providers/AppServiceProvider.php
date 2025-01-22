<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registruj bilo koju aplikacijsku uslugu.
     *
     * @return void
     */
    public function register()
    {
        // Ovdje možeš registrirati servise
    }

    /**
     * Podesi sve servise u aplikaciji.
     *
     * @return void
     */
    public function boot()
{
    // Registruj sve API rute
    Route::prefix('api')
     ->middleware('api')
     ->group(base_path('routes/api.php'));

}

    /**
     * Mapira API rute za aplikaciju.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api') // Dodajemo prefiks 'api' za sve rute u API
             ->middleware('api') // Ovaj middleware osigurava da su rute za API
             ->group(base_path('routes/api.php')); // Ovdje će biti definisane API rute
    }
}
