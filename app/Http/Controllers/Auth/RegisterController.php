<?php
namespace App\Http\Controllers\Auth;

use App\Models\Korisnik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validacija unetih podataka
        $validator = Validator::make($request->all(), [
            'ime' => 'required|string|max:255',
            'prezime' => 'required|string|max:255',
            'email' => 'required|email|unique:korisnici,email',
            'lozinka' => 'required|string|confirmed|min:8',
        ], [
            'ime.required' => 'Name is required.',
            'prezime.required' => 'Last name is required.',
            'email.required' => 'Email is required.',
            'lozinka.required' => 'Password is required.',
            'lozinka.confirmed' => 'Password confirmation does not match.',
            'email.email' => 'Email format is invalid.',
            'lozinka.min' => 'Password must be at least 8 characters.',
        ]);

        // Ako validacija ne uspe, vraćamo greške
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Kreiranje novog korisnika
        $user = Korisnik::create([
            'ime' => $request->ime,
            'prezime' => $request->prezime,
            'email' => $request->email,
            'lozinka' => Hash::make($request->lozinka),
        ]);

        // Logovanje korisnika nakon registracije (ako je potrebno)
        Auth::login($user);

        // Vraćanje odgovora sa statusom 201 (Created)
        return response()->json(['message' => 'User registered and logged in successfully', 'user' => $user], 201);
    }
}
