<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Izlozba;

class IzlozbaSeeder extends Seeder
{
    public function run()
    {
        Izlozba::create([
            'naziv' => 'Izložba Umjetnosti',
            'tema' => 'Moderna Umjetnost',
            'lokacija' => 'Galerija Moderna',
            'datum_pocetka' => now()->toDateString(),
            'datum_kraja' => now()->addMonth(1)->toDateString(),
            'dostupna_mesta' => 20,
            'galerija_id' => 1, 
        ]);

        Izlozba::create([
            'naziv' => 'Izložba Fotografija',
            'tema' => 'Prirodne Pejzaže',
            'lokacija' => 'Galerija Priroda',
            'datum_pocetka' => now()->addWeek(1)->toDateString(),
            'datum_kraja' => now()->addMonth(2)->toDateString(),
            'dostupna_mesta' => 30,
            'galerija_id' => 2, 
        ]);

        // Dodajte još unosa prema potrebi
    }
}
