<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login'    => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $loginInput = trim($request->input('login'));

        // Pemetaan akun demo cepat jika diklik dari daftar akun demo
        $demoUsers = [
            'admin' => ['email' => 'admin@sapa.sch.id', 'name' => 'Administrator SAPA'],
            '24101' => ['email' => 'siswa@sapa.sch.id', 'name' => 'Citra Kirana'],
            '24102' => ['email' => 'bagas.siswa@sapa.sch.id', 'name' => 'Bagas Aditya'],
            '24103' => ['email' => 'alya.siswa@sapa.sch.id', 'name' => 'Alya Zahra'],
            '24104' => ['email' => 'fajar.siswa@sapa.sch.id', 'name' => 'Fajar Nugroho'],
        ];

        $targetEmail = str_contains($loginInput, '@')
            ? $loginInput
            : ($demoUsers[$loginInput]['email'] ?? $loginInput);

        if (Auth::attempt(['email' => $targetEmail, 'password' => $request->input('password')])) {
            $request->session()->regenerate();

            $user = Auth::user();
            $isAdmin = str_contains(strtolower($user->email), 'admin') || strtolower((string) ($user->role ?? '')) === 'admin';

            return $isAdmin
                ? redirect()->route('dashboard')
                : redirect()->route('aspirasi.create');
        }

        // Jika akun demo siswa/admin belum ada di tabel users, buat otomatis saat login dengan password demo
        if (isset($demoUsers[$loginInput]) && in_array($request->input('password'), ['siswa123', 'admin123'], true)) {
            $user = User::firstOrCreate(
                ['email' => $demoUsers[$loginInput]['email']],
                [
                    'name'     => $demoUsers[$loginInput]['name'],
                    'password' => Hash::make($request->input('password')),
                ]
            );

            Auth::login($user);
            $request->session()->regenerate();

            return $loginInput === 'admin'
                ? redirect()->route('dashboard')
                : redirect()->route('aspirasi.create');
        }

        return back()->withErrors([
            'login' => 'Akun atau kata sandi tidak ditemukan.',
        ])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
} 