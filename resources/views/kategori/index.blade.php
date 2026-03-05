@extends('layouts.app')

@section('title', 'Kategori -   aduan Suara Sarana Sekolah')

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
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-4 md:p-6 text-white">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl md:text-2xl font-bold mb-2">Manajemen Kategori</h2>
                <p class="text-blue-100 text-sm md:text-base">Kelola kategori pengaduan untuk sistem sarana sekolah</p>
            </div>
            <a href="{{ route('kategori.create') }}" class="w-full sm:w-auto bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>Tambah Kategori
            </a>
        </div>
    </div>
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm text-gray-600 mb-1">Total Kategori</p>
                    <p class="text-xl md:text-2xl font-bold text-gray-800">{{ $totalKategori }}</p>
                    <p class="text-xs text-green-600 mt-2">
                        <i class="fas fa-check-circle"></i> Terdaftar
                    </p>
                </div>
                <div class="w-10 h-10 md:w-12 md:h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-tags text-blue-600 text-lg md:text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm text-gray-600 mb-1">Kategori Aktif</p>
                    <p class="text-xl md:text-2xl font-bold text-gray-800">{{ $totalAktif }}</p>
                    <p class="text-xs text-green-600 mt-2">
                        <i class="fas fa-arrow-up"></i> {{ $totalKategori > 0 ? round(($totalAktif / $totalKategori) * 100, 1) : 0 }}% aktif
                    </p>
                </div>
                <div class="w-10 h-10 md:w-12 md:h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-toggle-on text-green-600 text-lg md:text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm text-gray-600 mb-1">Kategori Non-Aktif</p>
                    <p class="text-xl md:text-2xl font-bold text-gray-800">{{ $totalNonAktif }}</p>
                    <p class="text-xs text-orange-600 mt-2">
                        <i class="fas fa-toggle-off"></i> Perlu dicek
                    </p>
                </div>
                <div class="w-10 h-10 md:w-12 md:h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-orange-600 text-lg md:text-xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Kategori Table -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-4 md:px-6 py-3 md:py-4 border-b border-gray-200">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <h3 class="text-base md:text-lg font-semibold text-gray-800">Daftar Kategori</h3>
                <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                    <!-- Search Form -->
                    <form action="{{ route('kategori.index') }}" method="get" class="flex items-center space-x-2">
                        <div class="relative">
                            <input type="text" 
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Cari kategori..." 
                                   class="w-48 md:w-64 px-3 md:px-4 py-2 pl-8 md:pl-10 pr-4 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <i class="fas fa-search absolute left-2.5 md:left-3 top-2.5 text-gray-400 text-sm"></i>
                        </div>
                        <button type="submit" class="px-3 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    
                    <!-- Filter Form -->
                    <form action="{{ route('kategori.index') }}" method="get" class="flex items-center space-x-2">
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        <select name="status" onchange="this.form.submit()" class="px-3 md:px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Status</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </form>
                    
                    <!-- Clear Filters -->
                    @if(request()->hasAny(['search', 'status']))
                        <a href="{{ route('kategori.index') }}" class="px-3 py-2 bg-red-100 text-red-700 text-sm rounded-lg hover:bg-red-200 transition-colors duration-200">
                            <i class="fas fa-times mr-1"></i>Reset
                        </a>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full min-w-[600px]">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kategori</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Deskripsi</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Dibuat</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($kategoris as $kategori)
                    <tr>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-900">#{{ str_pad($kategori->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-6 h-6 md:w-8 md:h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-2 md:mr-3">
                                    <i class="fas {{ $kategori->icon ?? 'fa-door-open' }} text-blue-600 text-xs md:text-sm"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-900">{{ $kategori->nama }}</span>
                            </div>
                        </td>
                        <td class="px-3 md:px-6 py-2 md:py-4 text-sm text-gray-500 hidden sm:table-cell">{{ $kategori->deskripsi ?: '-' }}</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap">
                            @if($kategori->status)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Non-Aktif
                                </span>
                            @endif
                        </td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell">{{ $kategori->created_at->diffForHumans() }}</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-1 md:space-x-2">
                                <a href="{{ route('kategori.show', $kategori) }}" class="text-gray-600 hover:text-gray-900 p-1" title="Detail">
                                    <i class="fas fa-eye text-sm"></i>
                                </a>
                                <a href="{{ route('kategori.edit', $kategori) }}" class="text-blue-600 hover:text-blue-900 p-1" title="Edit">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                                <button type="button" onclick="confirmDelete({{ $kategori->id }}, '{{ $kategori->nama }}')" class="text-red-600 hover:text-red-900 p-1" title="Hapus">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 md:py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 md:w-16 md:h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-inbox text-gray-400 text-xl md:text-2xl"></i>
                                </div>
                                <p class="text-gray-500 font-medium text-sm md:text-base">Belum ada kategori</p>
                                <p class="text-gray-400 text-xs md:text-sm mt-1">Tambahkan kategori pertama untuk memulai</p>
                                <a href="{{ route('kategori.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-plus mr-2"></i>Tambah Kategori
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($kategoris->count() > 0)
        <div class="px-4 md:px-6 py-3 md:py-4 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="text-sm text-gray-700 text-center sm:text-left">
                    Menampilkan <span class="font-medium">{{ $kategoris->firstItem() }}</span> hingga <span class="font-medium">{{ $kategoris->lastItem() }}</span> dari <span class="font-medium">{{ $kategoris->total() }}</span> hasil
                </div>
                <div class="flex items-center justify-center sm:justify-end space-x-2">
                    {{ $kategoris->links() }}
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
        title: 'Hapus Kategori?',
        html: 'Apakah Anda yakin ingin menghapus kategori <strong>"' + nama + '"</strong>?<br><small>Tindakan ini tidak dapat dibatalkan.</small>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteForm').action = '/kategori/' + id;
            document.getElementById('deleteForm').submit();
        }
    });
}
</script>
@endsection