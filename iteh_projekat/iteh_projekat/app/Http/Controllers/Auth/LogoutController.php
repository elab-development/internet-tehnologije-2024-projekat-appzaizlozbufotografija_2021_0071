<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        

        // Proveri da li je korisnik autentifikovan putem sesije
        if (Auth::check()) {
            // Izvrši logout
            Auth::logout();
            $request->session()->invalidate();  // Invalidaš sesiju
            $request->session()->regenerateToken();  // Regeneriši CSRF token

            return response()->json(['message' => 'Logout successful'], 200);
        }

        return response()->json(['message' => 'User not authenticated'], 401);
    }
}
