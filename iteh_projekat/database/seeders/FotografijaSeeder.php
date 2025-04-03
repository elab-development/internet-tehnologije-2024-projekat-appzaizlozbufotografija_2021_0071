<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fotografija;

class FotografijaSeeder extends Seeder
{
    public function run()
    {
        // Primer unosa fotografija
        Fotografija::create([
            'naziv' => 'Fotografija Priroda 1',
            'opis' => 'Fotografija prirodnog pejzaža sa planinama.',
            'datum_kreiranja' => now(),
            'tehnika' => 'Digitalna',
            'izlozba_id' => 1, // Povezivanje sa izložbom ID 1
        ]);

        Fotografija::create([
            'naziv' => 'Fotografija Priroda 2',
            'opis' => 'Fotografija mora pri zalasku sunca.',
            'datum_kreiranja' => now(),
            'tehnika' => 'Analogna',
            'izlozba_id' => 2, // Povezivanje sa izložbom ID 2
        ]);

        // Dodajte više unosa po potrebi
    }
}
