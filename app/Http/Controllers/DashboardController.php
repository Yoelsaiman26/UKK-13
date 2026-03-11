<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get weekly data for current month
        $weeklyData = $this->getWeeklyDataForCurrentMonth();
        
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
                
            return view('dashboard', compact('aspirasi', 'kategori', 'totalAspirasi', 'pendingAspirasi', 'prosesAspirasi', 'selesaiAspirasi', 'weeklyData'));
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
                
            return view('dashboard', compact('aspirasi', 'kategori', 'totalAspirasi', 'pendingAspirasi', 'prosesAspirasi', 'selesaiAspirasi', 'weeklyData'));
        }
        
        // If not logged in, redirect to login
        return redirect()->route('login');
    }

    public function getWeeklyData()
    {
        $weeklyData = $this->getWeeklyDataForCurrentMonth();
        return response()->json($weeklyData);
    }

    private function getWeeklyDataForCurrentMonth()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;
        
        // Get all aspirasi for current month
        $query = \App\Models\Aspirasi::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear);
            
        // If user is siswa, only get their data
        if (auth()->guard('siswas')->check()) {
            $siswaId = auth()->guard('siswas')->user()->id;
            $query->where('siswa_id', $siswaId);
        }
        
        $aspirasis = $query->get();
        
        // Initialize weeks data
        $weeks = [
            'Minggu 1' => 0,
            'Minggu 2' => 0,
            'Minggu 3' => 0,
            'Minggu 4' => 0,
            'Minggu 5' => 0,
        ];
        
        // Group aspirasi by week
        foreach ($aspirasis as $aspirasi) {
            $weekNumber = $aspirasi->created_at->weekOfMonth ?? ceil($aspirasi->created_at->day / 7);
            $weekKey = "Minggu " . $weekNumber;
            
            if (isset($weeks[$weekKey])) {
                $weeks[$weekKey]++;
            }
        }
        
        return [
            'labels' => array_keys($weeks),
            'data' => array_values($weeks)
        ];
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
