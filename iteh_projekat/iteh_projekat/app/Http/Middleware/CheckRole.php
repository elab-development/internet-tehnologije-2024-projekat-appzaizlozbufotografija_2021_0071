<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
{
    $user = Auth::user();

    // Logovanje uloge korisnika
    \Log::info('Provera uloge korisnika: ' . $user->uloga->naziv);

    // Provera da li korisnik ima jednu od dozvoljenih uloga
    if (!$user || !in_array($user->uloga->naziv, $roles)) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    return $next($request);
}

}
