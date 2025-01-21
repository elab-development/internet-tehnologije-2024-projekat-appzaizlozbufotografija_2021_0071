<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Izlozba extends Model
{
    // Dodajte naziv tabele, ako je potrebno
    protected $table = 'izlozbe';

    // Ako ne koristiš automatsko vreme kreiranja i ažuriranja, dodaj:
    // public $timestamps = false;

    protected $fillable = [
        'naziv', 'tema', 'lokacija', 'datum_pocetka', 'datum_kraja', 'dostupna_mesta', 'galerija_id'
    ];

    // Definiši odnos sa Galerijom (jedna izložba je u jednoj galeriji)
    public function galerija()
    {
        return $this->belongsTo(Galerija::class); 
    }

    // Definiši odnos sa Prijavama (jedna izložba može imati više prijava)
    public function prijave()
    {
        return $this->hasMany(Prijava::class); 
    }
}
