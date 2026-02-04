<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;

class JurusanController extends Controller
{
    public function index(Request $request)
    {
        $query = Jurusan::query();
        
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where('nama', 'like', '%' . $searchTerm . '%');
        }
        
        $jurusans = $query->latest()->paginate(10);
        
        return view('master-data.jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        return view('master-data.jurusan.index');
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama' => 'required|string|max:255|unique:jurusans,nama',
        ]);
        Jurusan::create($validasi);
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil dihapus');
    }
}
