<?php



namespace App\Http\Controllers;

use App\Models\Prijava;
use Illuminate\Http\Request;

class PrijavaController extends Controller
{
    public function index() {
        return Prijava::all();
    }

    public function show($id) {
        return Prijava::findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'korisnik_id' => 'required|exists:korisnici,id',
            'izlozba_id' => 'required|exists:izlozbe,id',
            'datum_prijave' => 'required|date',
        ]);

        return Prijava::create($data);
    }

    public function update(Request $request, $id) {
        $data = $request->validate([
            'korisnik_id' => 'sometimes|required|exists:korisnici,id',
            'izlozba_id' => 'sometimes|required|exists:izlozbe,id',
            'datum_prijave' => 'sometimes|required|date',
        ]);

        $prijava = Prijava::findOrFail($id);
        $prijava->update($data);

        return $prijava;
    }

    public function destroy($id) {
        $prijava = Prijava::findOrFail($id);
        $prijava->delete();

        return response(null, 204);
    }
}

