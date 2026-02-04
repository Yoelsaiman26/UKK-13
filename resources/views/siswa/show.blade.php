@extends('layouts.app')

@section('title', 'Detail Siswa - Pengaduan Suara Sarana Sekolah')

@section('content')
<div class="space-y-6">
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
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div>
                    <h2 class="text-2xl font-bold mb-2">Detail Siswa</h2>
                    <p class="text-blue-100">Lihat informasi lengkap siswa</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('siswa.index') }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
    
    <!-- Student Info Card -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Informasi Siswa</h3>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Profile Photo -->
                <div class="md:col-span-1">
                    <div class="text-center">
                        @if($siswa->profile)
                            <img src="{{ asset('storage/' . $siswa->profile) }}" alt="{{ $siswa->nama }}" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover border-4 border-gray-200">
                        @else
                            <div class="w-32 h-32 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center border-4 border-gray-200">
                                <i class="fas fa-user text-gray-400 text-4xl"></i>
                            </div>
                        @endif
                        <h4 class="text-lg font-semibold text-gray-900">{{ $siswa->nama }}</h4>
                        <p class="text-sm text-gray-500">{{ $siswa->nisn }}</p>
                    </div>
                </div>
                
                <!-- Student Details -->
                <div class="md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Nama Lengkap</label>
                            <p class="text-gray-900">{{ $siswa->nama }}</p>
                        </div>
                        
                        <div>
                            <label class="text-sm font-medium text-gray-500">NISN</label>
                            <p class="text-gray-900">{{ $siswa->nisn }}</p>
                        </div>
                        
                        <div>
                            <label class="text-sm font-medium text-gray-500">Jurusan</label>
                            <p class="text-gray-900">
                                @if($siswa->jurusan)
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $siswa->jurusan->nama }}
                                    </span>
                                @else
                                    <span class="text-gray-400">Belum ada jurusan</span>
                                @endif
                            </p>
                        </div>
                        
                        <div>
                            <label class="text-sm font-medium text-gray-500">Kelas</label>
                            <p class="text-gray-900">{{ $siswa->kelas }}</p>
                        </div>
                        
                        <div>
                            <label class="text-sm font-medium text-gray-500">Tanggal Lahir</label>
                            <p class="text-gray-900">{{ $siswa->tgl_lahir->format('d F Y') }}</p>
                        </div>
                        
                        <div>
                            <label class="text-sm font-medium text-gray-500">Umur</label>
                            <p class="text-gray-900">{{ $siswa->tgl_lahir->age }} tahun</p>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <label class="text-sm font-medium text-gray-500">Alamat</label>
                        <p class="text-gray-900">{{ $siswa->alamat }}</p>
                    </div>
                    
                    <div class="mt-4">
                        <label class="text-sm font-medium text-gray-500">Dibuat</label>
                        <p class="text-gray-900">{{ $siswa->created_at->format('d F Y H:i') }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('siswa.edit', $siswa->id) }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                        <i class="fas fa-edit mr-2"></i>Edit Siswa
                    </a>
                    <button type="button" onclick="confirmDelete({{ $siswa->id }}, '{{ $siswa->nama }}')" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                        <i class="fas fa-trash mr-2"></i>Hapus Siswa
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="deleteForm" action="" method="post" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
function confirmDelete(id, nama) {
    Swal.fire({
        title: 'Hapus Siswa?',
        html: 'Apakah Anda yakin ingin menghapus siswa <strong>"' + nama + '"</strong>?<br><small>Tindakan ini tidak dapat dibatalkan.</small>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteForm').action = '/siswa/' + id;
            document.getElementById('deleteForm').submit();
        }
    });
}
</script>
@endsection