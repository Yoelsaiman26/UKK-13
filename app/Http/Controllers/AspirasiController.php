<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\Siswa;

class AspirasiController extends Controller
{
    public function index()
    {
        $aspirasis = Aspirasi::with(['kategori','siswa'])->latest()->get();
        $kategoris = Kategori::all();
        $siswas = Siswa::all();

        if(auth()->guard('siswas')->check()) {
            $aspirasis = $aspirasis->where('siswa_id', auth()->guard('siswas')->user()->id);
        }

        $siswaLogin = null;
        if(auth()->guard('siswas')->check()) {
            $siswaLogin = auth()->guard('siswas')->user();
        }

        return view('aspirasi.index', compact('aspirasis','kategoris','siswas','siswaLogin'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'siswa_id' => 'required|exists:siswas,id',
            'lokasi' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);
        $siswa = Siswa::findOrFail($request->siswa_id);

        Aspirasi::create([
            'judul' => $validated['judul'],
            'kategori_id' => $validated['kategori_id'],
            'siswa_id' => $validated['siswa_id'],
            'lokasi' => $validated['lokasi'] ?? null,
            'keterangan' => $validated['keterangan'] ?? null,
            'nis' => $siswa->nisn,
            'kelas' => $siswa->kelas
        ]);

        return redirect()->route('aspirasi.index')
            ->with('success','Aspirasi berhasil ditambahkan');
    }

    public function show($id)
    {
        $aspirasi = Aspirasi::with(['kategori','siswa'])->findOrFail($id);
        return view('aspirasi.show', compact('aspirasi'));
    }

    public function edit($id)
    {
        $aspirasi = Aspirasi::with(['kategori','siswa'])->findOrFail($id);
        return response()->json($aspirasi);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'siswa_id' => 'required|exists:siswas,id',
            'lokasi' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        $siswa = Siswa::findOrFail($request->siswa_id);

        $aspirasi->update([
            'judul' => $validated['judul'],
            'kategori_id' => $validated['kategori_id'],
            'siswa_id' => $validated['siswa_id'],
            'lokasi' => $validated['lokasi'] ?? null,
            'keterangan' => $validated['keterangan'] ?? null,
            'nis' => $siswa->nisn,
            'kelas' => $siswa->kelas
        ]);

        return redirect()->route('aspirasi.index')
            ->with('success','Aspirasi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->delete();

        return redirect()->route('aspirasi.index')
            ->with('success','Aspirasi berhasil dihapus');
    }

    public function umpanBalik(Request $request, $id)
    {
        $validated = $request->validate([
            'balasan' => 'required|string',
            'status' => 'required|in:pending,diproses,selesai',
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update([
            'balasan' => $validated['balasan'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('aspirasi.index')->with('success','Umpan balik berhasil ditambahkan');
    }
}
