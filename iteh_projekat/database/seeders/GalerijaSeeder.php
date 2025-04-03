<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Galerija;

class GalerijaSeeder extends Seeder
{
    public function run()
    {
        // Primer unosa galerija
        Galerija::create([
            'naziv' => 'Galerija Moderna',
            'opis' => 'Galerija posvećena savremenoj umetnosti i inovacijama.',
        ]);

        Galerija::create([
            'naziv' => 'Galerija Priroda',
            'opis' => 'Galerija koja istražuje lepotu prirodnih pejzaža i faune.',
        ]);

        // Dodajte još galerija po potrebi
    }
}
