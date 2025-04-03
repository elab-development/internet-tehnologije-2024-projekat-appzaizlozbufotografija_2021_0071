<?php

namespace App\Http\Controllers;

use App\Models\Prijava;
use App\Http\Resources\PrijavaResource;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class PrijavaController extends Controller
{
    public function index() {
        return PrijavaResource::collection(Prijava::with(['korisnik', 'izlozba'])->get());
    }

    public function show($id) {
        return new PrijavaResource(Prijava::with(['korisnik', 'izlozba'])->findOrFail($id));
    }

    public function store(Request $request) {
        $request->validate([
            'izlozba_id' => 'required|exists:izlozbe,id',
        ]);

        $korisnik = JWTAuth::parseToken()->authenticate();

        $postojeca = Prijava::where('korisnik_id', $korisnik->id)
            ->where('izlozba_id', $request->izlozba_id)
            ->first();

        if ($postojeca) {
            return response()->json(['message' => 'Već ste se prijavili na ovu izložbu.'], 409);
        }

        $prijava = Prijava::create([
            'korisnik_id' => $korisnik->id,
            'izlozba_id' => $request->izlozba_id,
            'datum_prijave' => now(),
            'status' => 'NA ČEKANJU',
        ]);

        return new PrijavaResource($prijava);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'status' => 'required|string',
        ]);

        $prijava = Prijava::findOrFail($id);
        $prijava->update(['status' => $request->status]);

        return new PrijavaResource($prijava);
    }

    public function destroy($id) {
        $prijava = Prijava::findOrFail($id);
        $prijava->delete();

        return response(null, 204);
    }
}

