<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::with('jurusan');
        
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama', 'like', '%' . $searchTerm . '%')
                  ->orWhere('nisn', 'like', '%' . $searchTerm . '%')
                  ->orWhere('kelas', 'like', '%' . $searchTerm . '%');
            });
        }
        
        $siswas = $query->latest()->paginate(10);
        
        return view('siswa.index', compact('siswas'));
    }

    public function create()
    {
        $jurusans = Jurusan::orderBy('nama')->get();
        return view('siswa.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama' => 'required|string|max:255',
            'nisn' => 'required|string|max:10|unique:siswas,nisn',
            'jurusan_id' => 'required|exists:jurusans,id',
            'kelas' => 'required|in:X,XI,XII',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('siswa/profiles', $filename, 'public');
            $validasi['profile'] = $path;
        }
        
        try {
            Siswa::create($validasi);
            return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan');
        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Error creating siswa: ' . $e->getMessage());
            
            // Kembalikan dengan error message
            return redirect()->route('siswa.create')
                ->withInput()
                ->with('error', 'Gagal menambahkan siswa: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $siswa = Siswa::with('jurusan')->findOrFail($id);
        return view('siswa.show', compact('siswa'));
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $jurusans = Jurusan::orderBy('nama')->get();
        return view('siswa.edit', compact('siswa', 'jurusans'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        
        $validasi = $request->validate([
            'nama' => 'required|string|max:255',
            'nisn' => 'required|string|max:10|unique:siswas,nisn,' . $id,
            'jurusan_id' => 'required|exists:jurusans,id',
            'kelas' => 'required|in:X,XI,XII',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        if ($request->hasFile('profile')) {
            if ($siswa->profile && Storage::disk('public')->exists($siswa->profile)) {
                Storage::disk('public')->delete($siswa->profile);
            }
            
            $file = $request->file('profile');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('siswa/profiles', $filename, 'public');
            $validasi['profile'] = $path;
        }
        
        $siswa->update($validasi);
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diperbarui');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        
        if ($siswa->profile && Storage::disk('public')->exists($siswa->profile)) {
            Storage::disk('public')->delete($siswa->profile);
        }
        
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus');
    }
}
