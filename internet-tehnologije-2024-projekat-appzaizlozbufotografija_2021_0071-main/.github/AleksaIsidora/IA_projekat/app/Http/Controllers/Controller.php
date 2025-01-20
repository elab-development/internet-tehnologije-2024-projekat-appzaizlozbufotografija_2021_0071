<?php

namespace App\Http\Controllers;

use App\Models\Prijava;
use Illuminate\Http\Request;

class PrijavaController extends Controller
{
    //Prikazivanje svih prijava
    public function index()
    {
        return response()->json(Prijava::all());
    }

    //Prikazivanje jedne prijave
    public function show($id)
    {
        $prijava = Prijava::find($id);
        if ($prijava) {
            return response()->json($prijava);
        }
        return response()->json(['message' => 'Not found'], 404);
    }

    //Kreiranje nove prijave
    public function store(Request $request)
    {
        $validated = $request->validate([
            'datumPrijave' => 'required|date',
            'qrKod' => 'required|string',
            'status' => 'required|string',
        ]);

        $prijava = Prijava::create($validated);

        return response()->json($prijava, 201);
    }

    //Ažuriranje prijave
    public function update(Request $request, $id)
    {
        $prijava = Prijava::find($id);
        if ($prijava) {
            $prijava->update($request->all());
            return response()->json($prijava);
        }

        return response()->json(['message' => 'Not found'], 404);
    }

    //Brisanje prijave
    public function destroy($id)
    {
        $prijava = Prijava::find($id);
        if ($prijava) {
            $prijava->delete();
            return response()->json(['message' => 'Deleted']);
        }

        return response()->json(['message' => 'Not found'], 404);
    }
}