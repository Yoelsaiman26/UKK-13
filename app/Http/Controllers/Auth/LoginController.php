<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if(Auth::guard('web')->check() || Auth::guard('siswas')->check()) {
            return redirect()->route('dashboard');
        }
        
        return view('auth.login');
    }
    public function login(Request $request)
    {
       $credentials = $request->validate([
           'email' => 'required|email',
           'password' => 'required',
       ]);

       if(Auth::guard('web')->attempt($credentials)){
           $request->session()->regenerate();
           return redirect()->route('dashboard');
       }

       return back()->withErrors([
           'email' => 'Email atau password salah',
       ])->withInput($request->only('email'));
    }

    public function loginSiswa(Request $request)
    {
       $request->validate([
           'nisn' => 'required',
       ]);
       $siswa = \App\Models\Siswa::where('nisn', $request->nisn)->first();
       
       if($siswa){
           Auth::guard('siswas')->login($siswa);
           $request->session()->regenerate();
           return redirect()->route('aspirasi.index');
       }

       return back()->withErrors([
           'nisn' => 'NISN tidak ditemukan',
       ])->withInput($request->only('nisn'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
    