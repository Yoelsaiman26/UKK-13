<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;

class LaporanController extends Controller
{
    public function index()
    {
        $aspirasis = Aspirasi::with(['siswa', 'kategori'])
            ->latest()
            ->paginate(10);
        
        return view('laporan.index', compact('aspirasis'));
    }

    public function create()
    {
        return view('laporan.create');
    }
}
