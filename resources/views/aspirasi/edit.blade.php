@extends('layouts.app')

@section('title', 'Edit Aspirasi - Suara Sarana Sekolah')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-4 md:p-6 text-white">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl md:text-2xl font-bold mb-2">Edit Aspirasi</h2>
                <p class="text-blue-100 text-sm md:text-base">Perbarui data aspirasi yang ada</p>
            </div>
            <a href="{{ route('aspirasi.index') }}" class="w-full sm:w-auto bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>
    
    <!-- Form Section -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-4 py-3 border-b border-gray-200">
            <h3 class="text-base md:text-lg font-semibold text-gray-800">Edit Aspirasi</h3>
        </div>
        
        <form action="{{ route('aspirasi.update', $aspirasi->id) }}" method="POST" class="px-4 py-6 space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Informasi Utama -->
            <div class="space-y-4">
                <h4 class="text-sm font-medium text-gray-900 border-b pb-2">Informasi Utama</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">
                            Judul Aspirasi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="judul" 
                               name="judul" 
                               required
                               value="{{ old('judul', $aspirasi->judul) }}"
                               placeholder="Masukkan judul aspirasi"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('judul') border-red-500 @enderror">
                        <p class="mt-1 text-xs text-gray-500">Judul singkat yang jelas</p>
                        @error('judul')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select id="kategori" 
                                name="kategori" 
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('kategori') border-red-500 @enderror">
                            <option value="">Pilih Kategori</option>
                            <option value="sarana" {{ old('kategori', $aspirasi->kategori) == 'sarana' ? 'selected' : '' }}>Sarana</option>
                            <option value="prasarana" {{ old('kategori', $aspirasi->kategori) == 'prasarana' ? 'selected' : '' }}>Prasarana</option>
                            <option value="layanan" {{ old('kategori', $aspirasi->kategori) == 'layanan' ? 'selected' : '' }}>Layanan</option>
                            <option value="lainnya" {{ old('kategori', $aspirasi->kategori) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        <p class="mt-1 text-xs text-gray-500">Kategori aspirasi</p>
                        @error('kategori')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Detail Aspirasi -->
            <div class="space-y-4">
                <h4 class="text-sm font-medium text-gray-900 border-b pb-2">Detail Aspirasi</h4>
                
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea id="deskripsi" 
                              name="deskripsi" 
                              rows="4"
                              required
                              placeholder="Jelaskan detail aspirasi Anda..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $aspirasi->deskripsi) }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">Jelaskan aspirasi secara detail</p>
                    @error('deskripsi')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">
                        Lokasi
                    </label>
                    <input type="text" 
                           id="lokasi" 
                           name="lokasi" 
                           value="{{ old('lokasi', $aspirasi->lokasi) }}"
                           placeholder="Contoh: Ruang Kelas XI IPA 1"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('lokasi') border-red-500 @enderror">
                    <p class="mt-1 text-xs text-gray-500">Lokasi terkait aspirasi (opsional)</p>
                    @error('lokasi')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Informasi Pelapor -->
            <div class="space-y-4">
                <h4 class="text-sm font-medium text-gray-900 border-b pb-2">Informasi Pelapor</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nama_pelapor" class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Pelapor <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="nama_pelapor" 
                               name="nama_pelapor" 
                               required
                               value="{{ old('nama_pelapor', $aspirasi->nama_pelapor) }}"
                               placeholder="Nama lengkap pelapor"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama_pelapor') border-red-500 @enderror">
                        @error('nama_pelapor')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="kelas" class="block text-sm font-medium text-gray-700 mb-1">
                            Kelas
                        </label>
                        <input type="text" 
                               id="kelas" 
                               name="kelas" 
                               value="{{ old('kelas', $aspirasi->kelas) }}"
                               placeholder="Contoh: XI IPA 1"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('kelas') border-red-500 @enderror">
                        <p class="mt-1 text-xs text-gray-500">Opsional</p>
                        @error('kelas')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Status Section -->
            <div class="space-y-4">
                <h4 class="text-sm font-medium text-gray-900 border-b pb-2">Status Aspirasi</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select id="status" 
                                name="status" 
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror">
                            <option value="">Pilih Status</option>
                            <option value="pending" {{ old('status', $aspirasi->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="proses" {{ old('status', $aspirasi->status) == 'proses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ old('status', $aspirasi->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="ditolak" {{ old('status', $aspirasi->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        <p class="mt-1 text-xs text-gray-500">Status proses aspirasi</p>
                        @error('status')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">
                            Tanggal
                        </label>
                        <input type="date" 
                               id="tanggal" 
                               name="tanggal" 
                               value="{{ old('tanggal', $aspirasi->tanggal) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('tanggal') border-red-500 @enderror">
                        <p class="mt-1 text-xs text-gray-500">Tanggal aspirasi dibuat</p>
                        @error('tanggal')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('aspirasi.index') }}" class="w-full sm:w-auto px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200 text-center font-medium">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium">
                    <i class="fas fa-save mr-2"></i>Update Aspirasi
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Auto-resize textarea
document.getElementById('deskripsi').addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = (this.scrollHeight) + 'px';
});

// Initialize textarea height
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('deskripsi');
    textarea.style.height = 'auto';
    textarea.style.height = (textarea.scrollHeight) + 'px';
});
</script>
@endsection