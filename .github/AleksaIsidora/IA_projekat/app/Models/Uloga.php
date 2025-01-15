<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uloga extends Model
{
    public function korisnik()
    {
        return $this->belongsTo(Korisnik::class);
    }
}
