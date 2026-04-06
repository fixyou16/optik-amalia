<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    // Mengarahkan pengguna ke halaman login Google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // Menangani kembalian dari Google setelah sukses login
    public function callback()
    {
        try {
            // Ambil data user dari Google
            $googleUser = Socialite::driver('google')->user();

            // Cek apakah email tersebut sudah terdaftar di database kita
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // JIKA BELUM TERDAFTAR: Buat akun baru otomatis (Register)
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    // Beri password acak karena dia login pakai Google
                    'password' => Hash::make(Str::random(16)), 
                    'role' => 'customer' // Otomatis jadi pelanggan
                ]);
            } else {
                // JIKA SUDAH TERDAFTAR: Update google_id nya (jika sebelumnya daftar manual)
                $user->update([
                    'google_id' => $googleUser->getId()
                ]);
            }

            // Login-kan user tersebut
            Auth::login($user);

            // Arahkan sesuai Role (Sama seperti logika login manual)
            if ($user->role === 'super_admin') {
                return redirect()->route('admin.orders');
            }

            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            // Jika batal/gagal, kembalikan ke halaman login
            return redirect()->route('login')->with('error', 'Gagal login menggunakan Google.');
        }
    }
}