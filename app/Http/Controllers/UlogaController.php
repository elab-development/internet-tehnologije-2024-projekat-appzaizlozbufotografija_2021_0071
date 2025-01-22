<?php

namespace App\Http\Controllers;

use App\Models\Uloga;
use Illuminate\Http\Request;

class UlogaController extends Controller
{
    public function index() {
        return Uloga::all();
    }

    public function show($id) {
        return Uloga::findOrFail($id);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'naziv' => 'required|in:ADMINISTRATOR,POSETILAC,UMETNIK',
        ]);

        return Uloga::create($data);
    }

    public function update(Request $request, $id) {
        $data = $request->validate([
            'naziv' => 'sometimes|required|in:ADMINISTRATOR,POSETILAC,UMETNIK',
        ]);

        $uloga = Uloga::findOrFail($id);
        $uloga->update($data);

        return $uloga;
    }

    public function destroy($id) {
        $uloga = Uloga::findOrFail($id);
        $uloga->delete();

        return response(null, 204);
    }
}
