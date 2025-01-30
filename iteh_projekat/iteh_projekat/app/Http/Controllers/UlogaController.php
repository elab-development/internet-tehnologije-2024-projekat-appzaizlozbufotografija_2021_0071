<?php

// app/Http/Controllers/UlogaController.php
namespace App\Http\Controllers;

use App\Models\Uloga;
use Illuminate\Http\Request;

class UlogaController extends Controller
{
    // Vraća sve uloge
    public function index() {
        return Uloga::all();
    }

    // Vraća određenu ulogu po ID-u
    public function show($id) {
        return Uloga::findOrFail($id);
    }

    // Kreira novu ulogu
    public function store(Request $request) {
        $data = $request->validate([
            'naziv' => 'required|in:ADMINISTRATOR,POSETILAC,UMETNIK', // Validaacija uloga
        ]);

        // Kreiranje nove uloge
        $uloga = Uloga::create($data);

        // Vraćanje odgovora sa statusom 201
        return response()->json($uloga, 201);
    }

    // Ažurira postojeću ulogu
    public function update(Request $request, $id) {
        $data = $request->validate([
            'naziv' => 'sometimes|required|in:ADMINISTRATOR,POSETILAC,UMETNIK', // Validacija uloga
        ]);

        $uloga = Uloga::findOrFail($id);
        $uloga->update($data);

        // Vraćanje ažurirane uloge
        return response()->json($uloga, 200);
    }

    // Briše ulogu
    public function destroy($id) {
        $uloga = Uloga::findOrFail($id);
        $uloga->delete();

        // Vraćanje statusa 204 (No Content) za uspešan delete
        return response()->json(null, 204);
    }
}
