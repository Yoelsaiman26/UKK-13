<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\Siswa;
use App\Models\Kategori;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AspirasiExport;
use App\Imports\AspirasiImport;
use Carbon\Carbon;

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

    public function exportPdf()
    {
        $aspirasis = Aspirasi::with(['siswa', 'kategori'])
            ->latest()
            ->get();
        
        $bulan = Carbon::now()->format('F Y');
        
        $pdf = Pdf::loadView('laporan.pdf', compact('aspirasis', 'bulan'));
        
        return $pdf->download('laporan_aspirasi_' . strtolower(Carbon::now()->format('F')) . '.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new AspirasiExport, 'laporan_aspirasi.xlsx');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048'
        ]);

        try {
            Excel::import(new AspirasiImport, $request->file('file'));
            return redirect()->route('laporan.index')->with('success', 'Data aspirasi berhasil diimport!');
        } catch (\Exception $e) {
            return redirect()->route('laporan.index')->with('error', 'Gagal mengimport data: ' . $e->getMessage());
        }
    }
}
