<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function pengaduanIndex()
    {
        return view('pengaduan.index');
    }

    public function saranaKelas()
    {
        return view('sarana.kelas');
    }

    public function saranaLaboratorium()
    {
        return view('sarana.laboratorium');
    }

    public function saranaPerpustakaan()
    {
        return view('sarana.perpustakaan');
    }

    public function saranaOlahraga()
    {
        return view('sarana.olahraga');
    }

    public function laporanIndex()
    {
        return view('laporan.index');
    }

    public function penggunaIndex()
    {
        return view('pengguna.index');
    }

    public function pengaturanProfil()
    {
        return view('pengaturan.profil');
    }

    public function pengaturanSistem()
    {
        return view('pengaturan.sistem');
    }
}
