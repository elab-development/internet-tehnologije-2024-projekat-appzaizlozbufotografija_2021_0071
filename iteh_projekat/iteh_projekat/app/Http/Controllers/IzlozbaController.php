<?php
namespace App\Http\Controllers;

use App\Models\Izlozba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IzlozbaController extends Controller
{
    // Metoda za prikazivanje svih izložbi
    public function index() {
        return Izlozba::all();
    }

    // Metoda za prikazivanje pojedinačne izložbe
    public function show($id) {
        return Izlozba::findOrFail($id);
    }

    // Metoda za kreiranje nove izložbe
    public function store(Request $request) {
        // Verifikacija da li je korisnik autentifikovan
        $this->authorize('create', Izlozba::class); // Ovo koristi autorize politiku, koju ćemo kasnije objasniti

        // Validacija podataka
        $data = $request->validate([
            'naziv' => 'required|string|max:255',
            'tema' => 'required|string|max:255',
            'lokacija' => 'required|string|max:255',
            'datum_pocetka' => 'required|date',
            'datum_kraja' => 'required|date|after_or_equal:datum_pocetka',
            'dostupna_mesta' => 'required|integer|min:0',
            'galerija_id' => 'required|exists:galerije,id',
        ]);

        // Kreiranje nove izložbe
        $izlozba = Izlozba::create($data);

        return response()->json([
            'message' => 'Izložba uspešno kreirana!',
            'data' => $izlozba,
        ], 201);
    }

    // Metoda za ažuriranje postojeće izložbe
    public function update(Request $request, $id) {
        // Verifikacija da li je korisnik autentifikovan
        $this->authorize('update', Izlozba::class); // Koristi politiku da proveriš dozvole za ažuriranje

        // Validacija podataka
        $data = $request->validate([
            'naziv' => 'sometimes|required|string|max:255',
            'tema' => 'sometimes|required|string|max:255',
            'lokacija' => 'sometimes|required|string|max:255',
            'datum_pocetka' => 'sometimes|required|date',
            'datum_kraja' => 'sometimes|required|date|after_or_equal:datum_pocetka',
            'dostupna_mesta' => 'sometimes|required|integer|min:0',
            'galerija_id' => 'sometimes|required|exists:galerije,id',
        ]);

        // Pronaći izložbu po ID-u
        $izlozba = Izlozba::findOrFail($id);
        $izlozba->update($data);

        return response()->json([
            'message' => 'Izložba uspešno ažurirana!',
            'data' => $izlozba,
        ]);
    }

    // Metoda za brisanje izložbe
    public function destroy($id) {
        // Verifikacija da li je korisnik autentifikovan
        $this->authorize('delete', Izlozba::class); // Koristi politiku da proveriš dozvole za brisanje

        // Pronaći izložbu po ID-u
        $izlozba = Izlozba::findOrFail($id);
        $izlozba->delete();

        return response()->json([
            'message' => 'Izložba uspešno obrisana!',
        ], 204);
    }
}
