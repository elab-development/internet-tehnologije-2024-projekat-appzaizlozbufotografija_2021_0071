<?php

namespace App\Http\Controllers;

use App\Models\Fotografija;
use Illuminate\Http\Request;

class FotografijaController extends Controller
{
    // GET metod za sve fotografije
    public function index() {
        return Fotografija::all();
    }

    // GET metod za jednu fotografiju po ID-u
    public function show($id) {
        return Fotografija::findOrFail($id);
    }

    // POST metod za kreiranje nove fotografije
    public function store(Request $request) {
        $data = $request->validate([
            'naziv' => 'required|string|max:255',
            'opis' => 'required|string',
            'datum_kreiranja' => 'required|date',
            'tehnika' => 'required|string|max:255',
            'izlozba_id' => 'required|exists:izlozbe,id',
        ]);
    
        return Fotografija::create($data);
    
    }

    // PUT metod za ažuriranje postojećih fotografija
    public function update(Request $request, $id) {
        $data = $request->validate([
            'naziv' => 'sometimes|required|string|max:255',
            'opis' => 'sometimes|required|string',
            'datum_kreiranja' => 'sometimes|required|date',
            'tehnika' => 'sometimes|required|string|max:255',
            'izlozba_id' => 'sometimes|required|exists:izlozbe,id',
        ]);

        // Pronalaženje fotografije po ID-u i ažuriranje
        $fotografija = Fotografija::findOrFail($id);
        $fotografija->update($data);

        return $fotografija;
    }

    // DELETE metod za brisanje fotografije
    public function destroy($id) {
        $fotografija = Fotografija::findOrFail($id);
        $fotografija->delete();

        return response(null, 204); // Success, no content
    }
}
