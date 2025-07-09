<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Memeriksa apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect('/login')->withErrors(['username' => 'Anda harus login terlebih dahulu']);
        }

        // Menampilkan halaman dashboard pengguna
        return view('dashboard.index');
    }

    public function orders()
    {
        // Memeriksa apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect('/login')->withErrors(['username' => 'Anda harus login terlebih dahulu']);
        }

        // Mengambil pesanan pengguna dari database
        $orders = Auth::user()->orders; // Pastikan relasi 'orders' ada di model User

        return view('dashboard.orders', compact('orders'));
    }

    public function profile()
    {
        // Memeriksa apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect('/login')->withErrors(['username' => 'Anda harus login terlebih dahulu']);
        }

        // Menampilkan profil pengguna
        return view('dashboard.profile', ['user' => Auth::user()]);
    }

    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //     return redirect('/login')->with('success', 'Anda telah logged out.');
    // }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}