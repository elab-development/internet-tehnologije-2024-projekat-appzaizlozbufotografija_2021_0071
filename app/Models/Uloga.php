<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uloga extends Model
{
    protected $table = 'uloge';

    // Ako koristiš fillable ili guarded, dodaj to ovde
    protected $fillable = ['naziv'];  // Primer ako postoji fillable atribut
}
