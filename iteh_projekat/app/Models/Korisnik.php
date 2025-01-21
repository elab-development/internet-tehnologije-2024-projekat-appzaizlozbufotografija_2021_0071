<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Korisnik extends Authenticatable  
{
    use HasFactory;

    // Dodaj naziv tabele
    protected $table = 'korisnici';

    // Definiši koja polja mogu biti popunjena
    protected $fillable = [
        'ime', 'prezime', 'email', 'lozinka', // Dodaj lozinku
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
 



