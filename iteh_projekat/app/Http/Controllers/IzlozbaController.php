<?php

namespace App\Http\Controllers;

use App\Models\Izlozba;
use App\Http\Resources\IzlozbaResource;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class IzlozbaController extends Controller
{
    public function index() {
        return IzlozbaResource::collection(Izlozba::all());
    }

    public function show($id) {
        return new IzlozbaResource(Izlozba::findOrFail($id));
    }

    public function store(Request $request) {
        $user = JWTAuth::parseToken()->authenticate();

        $data = $request->validate([
            'naziv' => 'required|string|max:255',
            'tema' => 'required|string|max:255',
            'lokacija' => 'required|string|max:255',
            'datum_pocetka' => 'required|date',
            'datum_kraja' => 'required|date|after_or_equal:datum_pocetka',
            'dostupna_mesta' => 'required|integer|min:0',
            'galerija_id' => 'required|exists:galerije,id',
        ]);

        $izlozba = Izlozba::create($data);
        return new IzlozbaResource($izlozba);
    }

    public function update(Request $request, $id) {
        $user = JWTAuth::parseToken()->authenticate();

        $data = $request->validate([
            'naziv' => 'sometimes|required|string|max:255',
            'tema' => 'sometimes|required|string|max:255',
            'lokacija' => 'sometimes|required|string|max:255',
            'datum_pocetka' => 'sometimes|required|date',
            'datum_kraja' => 'sometimes|required|date|after_or_equal:datum_pocetka',
            'dostupna_mesta' => 'sometimes|required|integer|min:0',
            'galerija_id' => 'sometimes|required|exists:galerije,id',
        ]);

        $izlozba = Izlozba::findOrFail($id);
        $izlozba->update($data);
        return new IzlozbaResource($izlozba);
    }

    public function destroy($id) {
        $user = JWTAuth::parseToken()->authenticate();

        $izlozba = Izlozba::findOrFail($id);
        $izlozba->delete();

        return response()->json(['message' => 'Izložba uspešno obrisana!'], 204);
    }
}
