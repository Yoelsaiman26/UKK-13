<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $query = Kategori::query();
        
        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where('nama', 'like', '%' . $searchTerm . '%')
                  ->orWhere('deskripsi', 'like', '%' . $searchTerm . '%');
        }
        
        // Filter functionality
        if ($request->filled('status')) {
            $status = $request->input('status');
            $query->where('status', $status);
        }
        
        $kategoris = $query->latest()->paginate(10);
        $totalKategori = Kategori::count();
        $totalAktif = Kategori::where('status', true)->count();
        $totalNonAktif = Kategori::where('status', false)->count();
        
        return view('kategori.index', compact('kategoris', 'totalKategori', 'totalAktif', 'totalNonAktif'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'icon' => 'required|string|max:50',
            'status' => 'required|in:0,1',
        ]);

        $data['status'] = (bool) $data['status'];

        Kategori::create($data);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function show(Kategori $kategori)
    {
        return view('kategori.show', compact('kategori'));
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'icon' => 'required|string|max:50',
            'status' => 'required|in:0,1',
        ]);

        $data['status'] = (bool) $data['status'];

        $kategori->update($data);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }

}
