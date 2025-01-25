<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Korisnik;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validacija unetih podataka
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'lozinka' => 'required|string',
        ]);

        // Ako validacija ne uspe
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Proveri da li korisnik postoji sa datim email-om
        $user = Korisnik::where('email', $request->email)->first();

        // Ako korisnik postoji i lozinka je tačna
        if ($user && Hash::check($request->lozinka, $user->lozinka)) {
            // Generisanje tokena
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user,
            ], 200);
        }

        // Ako nisu tačni podaci
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        // Logika za logout korisnika
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Logout successful'], 200);
        }

        return response()->json(['message' => 'User not authenticated'], 401);
    }
}
