<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    // public function handle(Request $request, Closure $next, $role)
    // {
    //     // Periksa apakah pengguna sudah login
    //     if (!Auth::check()) {
    //         return redirect()->route('login');
    //     }

    //     // Periksa role pengguna
    //     $user = Auth::user();
    //     if ($user->role !== $role) {
    //         abort(403, 'Unauthorized action.'); // Tampilkan error 403 jika role tidak sesuai
    //     }

    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Periksa apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil role user
        $userRole = Auth::user()->role;

        // Periksa apakah role user ada di dalam daftar role yang diperbolehkan
        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
