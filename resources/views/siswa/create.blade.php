@extends('layouts.app')

@section('title', 'Tambah Siswa - Pengaduan Suara Sarana Sekolah')

@section('content')
<div class="space-y-6">
    <!-- Error Message Toast -->
    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                background: '#ef4444',
                color: '#ffffff',
                customClass: {
                    toast: 'swal2-toast-error'
                }
            });
        });
    </script>
    @endif
    
    <!-- Success Message Toast -->
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#10b981',
                color: '#ffffff',
                customClass: {
                    toast: 'swal2-toast-success'
                }
            });
        });
    </script>
    @endif
    
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-4 sm:p-6 text-white max-w-md md:max-w-full">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold mb-2">Tambah Siswa Baru</h2>
                    <p class="text-blue-100 text-sm sm:text-base">Tambahkan siswa baru untuk sistem sekolah</p>
                </div>
            </div>
            <a href="{{ route('siswa.index') }}" class="w-full sm:w-auto bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition-colors duration-200">
                <i class="fas hidden md:block fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>
    
    <!-- Form Section -->
    <div class="bg-white rounded-lg shadow max-w-md md:max-w-full">
        <div class="px-4 sm:px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Informasi Siswa</h3>
            <p class="text-sm text-gray-600 mt-1">Isi data lengkap siswa yang akan ditambahkan</p>
        </div>
        
        <form action="{{ route('siswa.store') }}" method="post" class="p-4 sm:p-6 space-y-6" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <!-- Nama Lengkap -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="nama" 
                           name="nama" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Masukkan nama lengkap siswa"
                           required>
                </div>
                
                <!-- NISN -->
                <div>
                    <label for="nisn" class="block text-sm font-medium text-gray-700 mb-2">
                        NISN <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="nisn" 
                           name="nisn" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Masukkan NISN"
                           maxlength="10"
                           required>
                </div>
                
                <!-- Jurusan -->
                <div>
                    <label for="jurusan_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Jurusan <span class="text-red-500">*</span>
                    </label>
                    <select id="jurusan_id" 
                            name="jurusan_id" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                        <option value="">-- Pilih Jurusan --</option>
                        @foreach($jurusans as $jurusan)
                        <option value="{{ $jurusan->id }}">{{ $jurusan->nama }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Kelas -->
                <div>
                    <label for="kelas" class="block text-sm font-medium text-gray-700 mb-2">
                        Kelas <span class="text-red-500">*</span>
                    </label>
                    <select id="kelas" 
                            name="kelas" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                        <option value="">-- Pilih Kelas --</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </div>
                
                <!-- Tanggal Lahir -->
                <div>
                    <label for="tgl_lahir" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal Lahir <span class="text-red-500">*</span>
                    </label>
                    <input type="date" 
                           id="tgl_lahir" 
                           name="tgl_lahir" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           required>
                </div>
                
                <!-- Profile -->
                <div>
                    <label for="profile" class="block text-sm font-medium text-gray-700 mb-2">
                        Profile Photo
                    </label>
                    <input type="file" 
                           id="profile" 
                           name="profile" 
                           accept="image/jpeg,image/png,image/jpg,image/gif"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <p class="mt-1 text-xs text-gray-500">Format: JPEG, PNG, JPG, GIF (Max: 2MB)</p>
                </div>
            </div>
            
            <!-- Alamat -->
            <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">
                    Alamat <span class="text-red-500">*</span>
                </label>
                <textarea id="alamat" 
                          name="alamat" 
                          rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                          placeholder="Masukkan alamat lengkap siswa"
                          required></textarea>
            </div>
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-3">
                <a href="{{ route('siswa.index') }}" class="w-full sm:w-auto px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-save mr-2"></i>Simpan Siswa
                </button>
            </div>
        </form>
    </div>
</div>
@endsection