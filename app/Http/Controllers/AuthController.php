<?php

// namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;

// class AuthController extends Controller
// {
//     // Menampilkan form registrasi
//     public function showRegistrationForm()
//     {
//         return view('auth.register'); // Pastikan view ini ada
//     }

//     // Menangani registrasi pengguna
//     public function register(Request $request)
//     {
//         $request->validate([
//             'username' => ['required', 'string', 'max:255', 'unique:users'],
//             'password' => 'required|min:6', // Tambahkan validasi panjang password
//             'name' => 'required',
//             'address' => ['required', 'string', 'max:255'],
//             'phone' => ['nullable', 'string', 'max:20'], //
//         ]);

//         User::create([
//             'username' => $request->username,
//             'password' => bcrypt($request->password),
//             'name' => $request->name,
//             'address' => $request->address,
//             'phone' => $request->phone, //
//         ]);

//         return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
//     }

//     // Menampilkan form login
//     public function showLoginForm()
//     {
//         return view('auth.login'); // Pastikan view ini ada
//     }

//     // Menangani login pengguna
//     public function login(Request $request)
//     {
//         $credentials = $request->only('username', 'password');

//         if (Auth::attempt($credentials)) {
//             // Pengalihan ke dashboard pengguna setelah login
//             return redirect()->route('user.dashboard')->with('success', 'Logged in successfully!');
//         }

//         return back()->withErrors(['username' => 'Invalid credentials']);
//     }

//     // Menangani logout pengguna
//     public function logout()
//     {
//         Auth::logout();
//         return redirect()->route('login')->with('success', 'Logged out successfully!');
//     }
// }


// namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class AuthController extends Controller
// {
//     // Menampilkan form registrasi
//     public function showRegistrationForm()
//     {
//         return view('auth.register');
//     }


//     // Menangani registrasi pengguna
//     public function register(Request $request)
//     {
//         $request->validate([
//             'username' => ['required', 'string', 'max:255', 'unique:users'],
//             'password' => 'required|min:6',
//             'name' => 'required',
//             'address' => ['required', 'string', 'max:255'],
//             'phone' => ['nullable', 'string', 'max:20'],
//             'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
//         ]);

//         // Simpan foto sebagai BLOB jika ada
//         $photoContent = null;
//         if ($request->hasFile('photo')) {
//             $photoContent = file_get_contents($request->file('photo')->getRealPath());
//         }

//         User::create([
//             'username' => $request->username,
//             'password' => bcrypt($request->password),
//             'name' => $request->name,
//             'address' => $request->address,
//             'phone' => $request->phone,
//             'photo' => $photoContent,
//         ]);

//         return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
//     }


//     // Menampilkan form login
//     public function showLoginForm()
//     {
//         return view('auth.login');
//     }

//     // Menangani login pengguna
//     public function login(Request $request)
//     {
//         $credentials = $request->only('username', 'password');

//         if (Auth::attempt($credentials)) {
//             return redirect()->route('user.dashboard')->with('success', 'Logged in successfully!');
//         }

//         return back()->withErrors(['username' => 'Invalid credentials']);
//     }

//     // Logout
//     public function logout()
//     {
//         Auth::logout();
//         return redirect()->route('login')->with('success', 'Logged out successfully!');
//     }

// }


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Menangani registrasi pengguna
    public function register(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => 'required|min:6',
            'name' => 'required',
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        // Simpan foto sebagai BLOB jika ada
        $photoContent = null;
        if ($request->hasFile('photo')) {
            $photoContent = file_get_contents($request->file('photo')->getRealPath());
        }

        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'photo' => $photoContent, // disimpan ke kolom BLOB
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }

    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani login pengguna
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('user.dashboard')->with('success', 'Logged in successfully!');
        }

        return back()->withErrors(['username' => 'Invalid credentials']);
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
