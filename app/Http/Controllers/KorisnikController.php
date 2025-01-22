<?php

namespace App\Http\Controllers;

use App\Models\Korisnik;
use Illuminate\Http\Request;

class KorisnikController extends Controller
{
    // Prikaz svih korisnika
    public function index() {
        return Korisnik::all();
    }

    // Prikaz jednog korisnika po ID-u
    public function show($id) {
        return Korisnik::findOrFail($id);
    }

    // Kreiranje novog korisnika
    public function store(Request $request) {
        $data = $request->validate([
            'ime' => 'required|string|max:255',
            'prezime' => 'required|string|max:255',
            'email' => 'required|email|unique:korisnici,email',
            'lozinka' => 'required|string|min:6',  // Lozinka mora biti duga najmanje 6 karaktera
        ]);

        // Šifrovanje lozinke
        $data['lozinka'] = bcrypt($data['lozinka']);

        // Kreiranje korisnika
        $korisnik = Korisnik::create($data);

        // Vraćanje odgovora sa statusom 201 (kreiran)
        return response()->json($korisnik, 201);
    }

    // Ažuriranje postojećeg korisnika
    public function update(Request $request, $id) {
        $data = $request->validate([
            'ime' => 'sometimes|required|string|max:255',
            'prezime' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:korisnici,email,' . $id,  // Ovdje se izuzima trenutni korisnik prilikom validacije emaila
            'lozinka' => 'sometimes|required|string|min:6',  // Lozinka je opcionalna za ažuriranje
        ]);

        $korisnik = Korisnik::findOrFail($id);
        
        // Ako postoji nova lozinka, šifruj je pre nego što je ažuriraš
        if (isset($data['lozinka'])) {
            $data['lozinka'] = bcrypt($data['lozinka']);
        }

        // Ažuriranje korisnika
        $korisnik->update($data);

        return response()->json($korisnik);
    }

    // Brisanje korisnika
    public function destroy($id) {
        $korisnik = Korisnik::findOrFail($id);
        $korisnik->delete();

        return response(null, 204);  // Vraća prazan odgovor sa statusom 204
    }
}
