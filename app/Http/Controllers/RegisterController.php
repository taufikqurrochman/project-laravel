<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// agar terhubung dengan model user
use App\Models\User;

// agar fungsi hash dapat berjalan
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        // file index.blade ada didalam folder register
        return view('register.index', [
            'title' => 'Registration',
            // sengaja dibuat ga ktemu, ini link ke navbar
             'active' => 'register'
        ]);
    }

    public function store(Request $request)
    {
        // validate disini menangkap dari name diinputan form
        // data ditampung dalam variabel validatedData
        $validatedData = $request->validate([
            'name' => 'required|max:50|min:5',
            'username' => 'required|min:5|max:50|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:50'
        ]);

        // dd('register berhasil');

        // enkrip password
        //$validatedData['password' = bcrypt($validatedData['password']);
        // cara enkrip yang lain
        $validatedData['password'] = Hash::make($validatedData['password']);

        // menambah user dengan parameter $validatedData
        User::create($validatedData);

        // setelah login pindah ke halaman login, lalu mengecek dialert sucess
        return redirect('/login')->with('success', 'Registration succesfull! Please login');
    }
}