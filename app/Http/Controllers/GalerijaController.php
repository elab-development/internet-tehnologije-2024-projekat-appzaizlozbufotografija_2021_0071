<?php

namespace App\Http\Controllers;

use App\Models\Galerija;
use Illuminate\Http\Request;

class GalerijaController extends Controller
{
    public function index()
    {
        // Vraća sve galerije
        return Galerija::all();
    }

    public function show($id)
    {
        // Pronalazi galeriju po ID-u ili baca grešku ako ne postoji
        return Galerija::findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'naziv' => 'required|string|max:255',
            'opis' => 'required|string',
        ]);

        return Galerija::create($data); // Kreira novu galeriju
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'naziv' => 'sometimes|required|string|max:255',
            'opis' => 'sometimes|required|string',
        ]);

        $galerija = Galerija::findOrFail($id);
        $galerija->update($data);

        return $galerija;
    }

    public function destroy($id)
    {
        $galerija = Galerija::findOrFail($id);
        $galerija->delete();

        return response(null, 204); // Brisanje galerije
    }
}
