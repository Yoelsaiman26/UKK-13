<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Check if user is logged in as admin (web guard)
        if (auth()->guard('web')->check()) {
            // Admin Dashboard - Show all aspirasi from all siswa
            $aspirasi = \App\Models\Aspirasi::with(['siswa', 'kategori'])
                ->latest()
                ->take(5)
                ->get();
                
            $kategori = \App\Models\Aspirasi::with('kategori')
                ->get()
                ->groupBy('kategori_id')
                ->map(function($item) {
                    return [
                        'name' => $item->first()->kategori->nama,
                        'count' => $item->count()
                    ];
                });
                
            // Statistics for all aspirasi
            $totalAspirasi = \App\Models\Aspirasi::count();
            $pendingAspirasi = \App\Models\Aspirasi::where('status', 'pending')->count();
            $prosesAspirasi = \App\Models\Aspirasi::where('status', 'diproses')->count();
            $selesaiAspirasi = \App\Models\Aspirasi::where('status', 'selesai')->count();
                
            return view('dashboard', compact('aspirasi', 'kategori', 'totalAspirasi', 'pendingAspirasi', 'prosesAspirasi', 'selesaiAspirasi'));
        }
        
        // Check if user is logged in as siswa (siswas guard)
        if (auth()->guard('siswas')->check()) {
            // Siswa Dashboard - Show only their own aspirasi
            $siswa = auth()->guard('siswas')->user();
            $siswaId = $siswa->id;
            
            $aspirasi = \App\Models\Aspirasi::with(['siswa', 'kategori'])
                ->where('siswa_id', $siswaId)
                ->latest()
                ->take(5)
                ->get();
                
            $kategori = \App\Models\Aspirasi::with('kategori')
                ->where('siswa_id', $siswaId)
                ->get()
                ->groupBy('kategori_id')
                ->map(function($item) {
                    return [
                        'name' => $item->first()->kategori->nama,
                        'count' => $item->count()
                    ];
                });
                
            // Statistics for this siswa's aspirasi only
            $totalAspirasi = \App\Models\Aspirasi::where('siswa_id', $siswaId)->count();
            $pendingAspirasi = \App\Models\Aspirasi::where('siswa_id', $siswaId)->where('status', 'pending')->count();
            $prosesAspirasi = \App\Models\Aspirasi::where('siswa_id', $siswaId)->where('status', 'diproses')->count();
            $selesaiAspirasi = \App\Models\Aspirasi::where('siswa_id', $siswaId)->where('status', 'selesai')->count();
                
            return view('dashboard', compact('aspirasi', 'kategori', 'totalAspirasi', 'pendingAspirasi', 'prosesAspirasi', 'selesaiAspirasi'));
        }
        
        // If not logged in, redirect to login
        return redirect()->route('login');
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
