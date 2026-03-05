@extends('layouts.app')

@section('title', 'Jurusan - Pengaduan Suara Sarana Sekolah')

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
    
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-4 md:p-6 text-white">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl md:text-2xl font-bold mb-2">Master Data Jurusan</h2>
                <p class="text-blue-100 text-sm md:text-base">Kelola data jurusan untuk sistem sekolah</p>
            </div>
        </div>
    </div>
    
    <!-- Form Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
        <!-- Main Form -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-lg shadow">
                <div class="px-4 md:px-6 py-3 md:py-4 border-b border-gray-200">
                    <h3 class="text-base md:text-lg font-semibold text-gray-800">Tambah Jurusan Baru</h3>
                    <p class="text-sm text-gray-600 mt-1">Isi informasi jurusan yang akan ditambahkan</p>
                </div>
                
                <form action="{{ route('jurusan.store') }}" method="post" class="p-4 md:p-6 space-y-4 md:space-y-6">
                    @csrf
                    <!-- Nama Jurusan -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Jurusan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="nama" 
                               name="nama" 
                               class="w-full px-3 md:px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm md:text-base"
                               placeholder="Contoh: Teknik Informatika, Akuntansi, dll"
                               required>
                        <p class="mt-1 text-xs text-gray-500">Nama jurusan akan digunakan untuk data siswa</p>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow p-4 md:p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="text-sm text-gray-600">
                                <i class="fas fa-info-circle mr-1"></i>
                                Pastikan nama jurusan sudah terisi dengan benar sebelum menyimpan
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-3 gap-2">
                                <button type="reset" class="w-full sm:w-auto px-4 md:px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                    <i class="fas fa-times mr-2"></i>Reset
                                </button>
                                <button type="submit" class="w-full sm:w-auto px-4 md:px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                    <i class="fas fa-save mr-2"></i>Simpan Jurusan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Jurusan Table -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-4 md:px-6 py-3 md:py-4 border-b border-gray-200">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <h3 class="text-base md:text-lg font-semibold text-gray-800">Daftar Jurusan</h3>
                <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                    <!-- Search Form -->
                    <form action="{{ route('jurusan.index') }}" method="get" class="flex items-center space-x-2">
                        <div class="relative">
                            <input type="text" 
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Cari jurusan..." 
                                   class="w-48 md:w-64 px-3 md:px-4 py-2 pl-8 md:pl-10 pr-4 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <i class="fas fa-search absolute left-2.5 md:left-3 top-2.5 text-gray-400 text-sm"></i>
                        </div>
                        <button type="submit" class="px-3 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    
                    <!-- Clear Filters -->
                    @if(request('search'))
                        <a href="{{ route('jurusan.index') }}" class="px-3 py-2 bg-red-100 text-red-700 text-sm rounded-lg hover:bg-red-200 transition-colors duration-200">
                            <i class="fas fa-times mr-1"></i>Reset
                        </a>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full min-w-[500px]">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Jurusan</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Dibuat</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($jurusans as $jurusan)
                    <tr>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-900">#{{ str_pad($jurusan->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-6 h-6 md:w-8 md:h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-2 md:mr-3">
                                    <i class="fas fa-graduation-cap text-blue-600 text-xs md:text-sm"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-900">{{ $jurusan->nama }}</span>
                            </div>
                        </td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500 hidden sm:table-cell">{{ $jurusan->created_at->diffForHumans() }}</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-1 md:space-x-2">
                                <button type="button" onclick="confirmDelete({{ $jurusan->id }}, '{{ $jurusan->nama }}')" class="text-red-600 hover:text-red-900 p-1" title="Hapus">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 md:py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 md:w-16 md:h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-graduation-cap text-gray-400 text-xl md:text-2xl"></i>
                                </div>
                                <p class="text-gray-500 font-medium text-sm md:text-base">Belum ada jurusan</p>
                                <p class="text-gray-400 text-xs md:text-sm mt-1">Tambahkan jurusan pertama untuk memulai</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($jurusans->count() > 0)
        <div class="px-4 md:px-6 py-3 md:py-4 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="text-sm text-gray-700 text-center sm:text-left">
                    Menampilkan <span class="font-medium">{{ $jurusans->firstItem() }}</span> hingga <span class="font-medium">{{ $jurusans->lastItem() }}</span> dari <span class="font-medium">{{ $jurusans->total() }}</span> hasil
                </div>
                <div class="flex items-center justify-center sm:justify-end space-x-2">
                    {{ $jurusans->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<form id="deleteForm" action="" method="post" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
function confirmDelete(id, nama) {
    Swal.fire({
        title: 'Hapus Jurusan?',
        html: 'Apakah Anda yakin ingin menghapus jurusan <strong>"' + nama + '"</strong>?<br><small>Tindakan ini tidak dapat dibatalkan.</small>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteForm').action = '/jurusan/' + id;
            document.getElementById('deleteForm').submit();
        }
    });
}
</script>
@endsection 