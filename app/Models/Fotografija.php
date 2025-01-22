<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fotografija extends Model
{
    protected $table = 'fotografije';

    // Dodajte ove kolone u $fillable kako biste omogućili masovno dodeljivanje podataka
    protected $fillable = [
        'naziv', 'opis', 'datum_kreiranja', 'tehnika', 'izlozba_id'
    ];

    // Definišite vezu sa Izložbom (ako je potrebno)
    public function izlozbe()
    {
        return $this->belongsToMany(Izlozba::class, 'izlozba_fotografija');
    }
}
