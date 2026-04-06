<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
 public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Jika Super Admin, lempar ke Panel Admin
        if ($request->user()->role === 'super_admin') {
            return redirect()->route('admin.orders');
        }

        // JIKA PELANGGAN BIASA:
        // Cek apakah dia tadi sedang mencoba mengakses URL tertentu (seperti /cart)
        // Jika iya, kembalikan ke sana. Jika tidak, arahkan ke dashboard.
        return redirect()->intended(route('dashboard', absolute: false));
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
