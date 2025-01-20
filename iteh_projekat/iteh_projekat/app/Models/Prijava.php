<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prijava extends Model
{
    // Povezivanje sa tabelom 'prijave'
    protected $table = 'prijave';

    // Masovno dodeljivanje (mass assignment)
    protected $fillable = [
        'korisnik_id',
        'izlozba_id',
        'status',
        'datum_prijave',
        'qr_kod',
    ];

    // Veza sa modelom Korisnik
    public function korisnik()
    {
        return $this->belongsTo(Korisnik::class);
    }

    // Veza sa modelom Izlozba
    public function izlozba()
    {
        return $this->belongsTo(Izlozba::class);
    }
}
