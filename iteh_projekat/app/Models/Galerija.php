<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galerija extends Model
{
    // Dodajemo naziv tabele kako bi se izbegle greške sa pluralizacijom
    protected $table = 'galerije'; // Tabela u bazi podataka je 'galerije'

    protected $fillable = ['naziv', 'opis'];

    public function izlozbe()
    {
        return $this->hasMany(Izlozba::class); // Jedna galerija može imati više izložbi
    }
}
