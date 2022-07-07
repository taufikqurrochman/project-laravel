<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// agar fungsi validasi jalan
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        // file index.blade ada didalam folder login
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    // fungsi validasi login
    public function authenticate(Request $request)
    {
        // validasi lalu ditampung divariabel $credentials
        $credentials = $request->validate([
            // jika mau strict bisa tambahkan email:dns karena @example.org tidak bisa login dengan validasi ini
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // dd('berhasil login');

        // jika berhasil login akan jalan ke sini
        if (Auth::attempt($credentials)) {
            // regenerate agar login tidak bisa dihack
            $request->session()->regenerate();
            
            // pakai intended supaya masuk ke middleware
            return redirect()->intended('/dashboard');
        }

        // jika gagal maka akan return ke login dan menampilkan pesan login failed 
        return back()->with('loginError', 'Login failed!');
    }

    // function untuk log out
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
