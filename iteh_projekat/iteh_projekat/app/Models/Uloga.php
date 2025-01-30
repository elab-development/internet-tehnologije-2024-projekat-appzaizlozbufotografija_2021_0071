<?php

// app/Models/Uloga.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uloga extends Model
{
    protected $table = 'uloge';

    // Osiguravamo da je naziv uloge jedinstven
    protected $fillable = ['naziv'];

    // Veza sa korisnicima (jedna uloga može imati više korisnika)
    public function korisnici()
    {
        return $this->hasMany(Korisnik::class);
    }
}
