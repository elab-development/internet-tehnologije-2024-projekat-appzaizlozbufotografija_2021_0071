<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fotografija extends Model
{
    use HasFactory;

    protected $table = 'fotografije';

    // Uključujemo 'slika' u $fillable da bismo omogućili masovno dodeljivanje.
    protected $fillable = [
        'naziv', 
        'opis', 
        'datum_kreiranja', 
        'tehnika', 
        'slika',       
        'izlozba_id', 
        'korisnik_id'
    ];

    // Veza – jedna fotografija pripada jednoj izložbi.
    public function izlozba()
    {
        return $this->belongsTo(Izlozba::class, 'izlozba_id');
    }
}
