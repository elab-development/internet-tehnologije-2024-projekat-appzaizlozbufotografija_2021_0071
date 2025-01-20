<?php

namespace App\Http\Controllers;

use App\Models\Izlozba;
use Illuminate\Http\Request;

class IzlozbaController extends Controller
{
    public function index() {
        return Izlozba::all();
    }

    public function show($id) {
        return Izlozba::findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'naziv' => 'required|string|max:255',
            'tema' => 'required|string|max:255',
            'lokacija' => 'required|string|max:255',
            'datum_pocetka' => 'required|date',
            'datum_kraja' => 'required|date|after_or_equal:datum_pocetka',  // Popravljeno pravilo za datum kraja
            'dostupna_mesta' => 'required|integer|min:0',
            'galerija_id' => 'required|exists:galerije,id',
        ]);

        $izlozba = Izlozba::create($data);

        return response()->json([
            'message' => 'Izložba uspešno kreirana!',
            'data' => $izlozba,
        ], 201);
    }

    public function update(Request $request, $id) {
        $data = $request->validate([
            'naziv' => 'sometimes|required|string|max:255',
            'tema' => 'sometimes|required|string|max:255',
            'lokacija' => 'sometimes|required|string|max:255',
            'datum_pocetka' => 'sometimes|required|date',
            'datum_kraja' => 'sometimes|required|date|after_or_equal:datum_pocetka',  // Popravljeno pravilo za datum kraja
            'dostupna_mesta' => 'sometimes|required|integer|min:0',
            'galerija_id' => 'sometimes|required|exists:galerije,id',
        ]);

        $izlozba = Izlozba::findOrFail($id);
        $izlozba->update($data);

        return response()->json([
            'message' => 'Izložba uspešno ažurirana!',
            'data' => $izlozba,
        ]);
    }

    public function destroy($id) {
        $izlozba = Izlozba::findOrFail($id);
        $izlozba->delete();

        return response()->json([
            'message' => 'Izložba uspešno obrisana!',
        ], 204);
    }
}
