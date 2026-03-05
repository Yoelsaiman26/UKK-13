@extends('layouts.app')

@section('title', 'Siswa - Pengaduan Suara Sarana Sekolah')

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
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-4 sm:p-6 text-white">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold mb-2">Manajemen Siswa</h2>
                <p class="text-blue-100 text-sm sm:text-base">Kelola data siswa untuk sistem sekolah</p>
            </div>
            <a href="{{ route('siswa.create') }}" class="w-full sm:w-auto bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>Tambah Siswa
            </a>
        </div>
    </div>
    
    <!-- Siswa Table -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-4 md:px-6 py-3 md:py-4 border-b border-gray-200">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <h3 class="text-base md:text-lg font-semibold text-gray-800">Daftar Siswa</h3>
                <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                    <!-- Search Form -->
                    <form action="{{ route('siswa.index') }}" method="get" class="flex items-center space-x-2">
                        <div class="relative">
                            <input type="text" 
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Cari siswa..." 
                                   class="w-48 md:w-64 px-3 md:px-4 py-2 pl-8 md:pl-10 pr-4 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <i class="fas fa-search absolute left-2.5 md:left-3 top-2.5 text-gray-400 text-sm"></i>
                        </div>
                        <button type="submit" class="px-3 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    
                    <!-- Clear Filters -->
                    @if(request('search'))
                        <a href="{{ route('siswa.index') }}" class="px-3 py-2 bg-red-100 text-red-700 text-sm rounded-lg hover:bg-red-200 transition-colors duration-200">
                            <i class="fas fa-times mr-1"></i>Reset
                        </a>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto -mx-4 sm:mx-0">
            <div class="inline-block min-w-full align-middle">
                <table class="w-full min-w-[500px]  lg:min-w-[900px]">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-2 md:px-4 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">Foto</th>
                            <th class="px-2 md:px-4 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-2 md:px-4 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell w-24">NISN</th>
                            <th class="px-2 md:px-4 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Jurusan</th>
                            <th class="px-2 md:px-4 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">Kelas</th>
                            <th class="px-2 md:px-4 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-20">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($siswas as $siswa)
                        <tr>
                            <td class="px-2 md:px-4 py-2 md:py-4 whitespace-nowrap">
                                @if($siswa->profile)
                                    <img src="{{ asset('storage/' . $siswa->profile) }}" alt="{{ $siswa->nama }}" class="w-8 h-8 md:w-10 md:h-10 rounded-full object-cover">
                                @else
                                    <div class="w-8 h-8 md:w-10 md:h-10 bg-gray-200 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-gray-400 text-sm md:text-base"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-2 md:px-4 py-2 md:py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 truncate max-w-[120px] sm:max-w-none">{{ $siswa->nama }}</div>
                                <div class="text-xs text-gray-500">{{ $siswa->tgl_lahir->format('d/m/Y') }}</div>
                            </td>
                            <td class="px-2 md:px-4 py-2 md:py-4 whitespace-nowrap text-sm text-gray-900 hidden sm:table-cell">{{ $siswa->nisn }}</td>
                            <td class="px-2 md:px-4 py-2 md:py-4 whitespace-nowrap text-sm text-gray-900 hidden md:table-cell">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $siswa->jurusan->nama ?? 'Belum ada jurusan' }}
                                </span>
                            </td>
                            <td class="px-2 md:px-4 py-2 md:py-4 whitespace-nowrap text-sm text-gray-900">{{ $siswa->kelas }}</td>
                            <td class="px-2 md:px-4 py-2 md:py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-1 md:space-x-2">
                                    <a href="{{ route('siswa.show', $siswa->id) }}" class="text-blue-600 hover:text-blue-900 p-1" title="Detail">
                                        <i class="fas fa-eye text-sm"></i>
                                    </a>
                                    <a href="{{ route('siswa.edit', $siswa->id) }}" class="text-green-600 hover:text-green-900 p-1" title="Edit">
                                        <i class="fas fa-edit text-sm"></i>
                                    </a>
                                    <button type="button" onclick="confirmDelete({{ $siswa->id }}, '{{ $siswa->nama }}')" class="text-red-600 hover:text-red-900 p-1" title="Hapus">
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
                                        <i class="fas fa-user-graduate text-gray-400 text-xl md:text-2xl"></i>
                                    </div>
                                    <p class="text-gray-500 font-medium text-sm md:text-base">Belum ada siswa</p>
                                    <p class="text-gray-400 text-xs md:text-sm mt-1">Tambahkan siswa pertama untuk memulai</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        @if($siswas->count() > 0)
        <div class="px-4 md:px-6 py-3 md:py-4 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="text-sm text-gray-700 text-center sm:text-left">
                    Menampilkan <span class="font-medium">{{ $siswas->firstItem() }}</span> hingga <span class="font-medium">{{ $siswas->lastItem() }}</span> dari <span class="font-medium">{{ $siswas->total() }}</span> hasil
                </div>
                <div class="flex items-center justify-center sm:justify-end space-x-2">
                    {{ $siswas->links() }}
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