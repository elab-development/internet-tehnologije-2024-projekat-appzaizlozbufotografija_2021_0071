<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prijava extends Model
{
    use HasFactory;

    // Definisanje relacija

    // Relacija sa Izlozba modelom (Prijava pripada Izložbi)
    public function izlozba()
    {
        return $this->belongsTo(Izlozba::class);
    }

    // Relacija sa Korisnik modelom (Prijava pripada Korisniku)
    public function korisnik()
    {
        return $this->belongsTo(Korisnik::class);
    }
}
