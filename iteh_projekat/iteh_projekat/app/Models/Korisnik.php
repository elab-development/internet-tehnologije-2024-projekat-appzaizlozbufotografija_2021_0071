<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens; // Dodaj ovu liniju
use Illuminate\Database\Eloquent\Factories\HasFactory; // Dodaj HasFactory

class Korisnik extends Authenticatable  
{
    use HasApiTokens, HasFactory;  // Dodaj HasApiTokens

    // Dodaj naziv tabele
    protected $table = 'korisnici';

    // Definiši koja polja mogu biti popunjena
    protected $fillable = [
        'ime', 'prezime', 'email', 'lozinka', 'uloga_id', // Dodaj ulogu
    ];

    // Veza sa prijavama (jedan korisnik može imati mnogo prijava)
    public function prijave()
    {
        return $this->hasMany(Prijava::class);
    }

    // Veza sa ulogom (jedan korisnik ima jednu ulogu)
    public function uloga()
    {
        return $this->belongsTo(Uloga::class);
    }
    
    public function getAuthPassword()
    {
        return $this->lozinka;  // Koristi lozinku iz tabele
    }

    // Definisanje veza sa drugim modelima
}
