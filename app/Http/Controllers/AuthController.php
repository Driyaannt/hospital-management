<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function index()
    {
        return view('layouts.login.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string', // Validasi username
            'password' => 'required|string',
        ]);

        // Coba login dengan username dan password
        if (Auth::attempt($request->only('username', 'password'))) {
            $request->session()->regenerate(); // Regenerasi session untuk keamanan

            // Jika menggunakan Sanctum, buat token
            $user = User::where('username', $request->username)->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;

            // Redirect ke dashboard berdasarkan role
            $redirectUrl = $this->getRedirectUrlBasedOnRole($user->role);

            return response()->json([
                'message' => 'Login successful',
                'access_token' => $token, // Kirim token jika menggunakan Sanctum
                'token_type' => 'Bearer',
                'redirect' => $redirectUrl // URL redirect berdasarkan role
            ], 200);
        }

        // Jika login gagal, kembalikan pesan error
        return response()->json(['message' => 'Username atau password salah'], 401);
    }

    /**
     * Mendapatkan URL redirect berdasarkan role pengguna.
     *
     * @param string $role
     * @return string
     */
    protected function getRedirectUrlBasedOnRole($role)
    {
        switch ($role) {
            case 'admin':
                return url('/dashboard');
            case 'dokter':
                return url('/dashboard');
            case 'perawat':
                return url('/dashboard');
            case 'apoteker':
                return url('/dashboard');
            default:
                return url('/dashboard');
        }
    }

    // Proses logout
    public function logout(Request $request)
    {
        // Hapus token Sanctum
        $request->user()->tokens()->delete();

        // Logout pengguna
        Auth::logout();
        $request->session()->invalidate(); // Invalidasi session
        $request->session()->regenerateToken(); // Regenerasi CSRF token

        return redirect('/'); // Redirect ke halaman login
    }

    // Reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['message' => 'Password reset successfully'], 200);
        }

        return response()->json(['message' => 'User not found'], 404);
    }

    // Forgot password
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Reset link sent to your email'], 200)
            : response()->json(['message' => 'Unable to send reset link'], 400);
    }
}
