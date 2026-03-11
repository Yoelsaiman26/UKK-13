@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-4 md:p-6 text-white">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl md:text-2xl font-bold mb-2">Laporan Aspirasi</h2>
                <p class="text-blue-100 text-sm md:text-base">Lihat dan kelola semua data aspirasi siswa</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-2">
                <!-- Import Excel Form -->
                <form action="{{ route('laporan.import.excel') }}" method="POST" enctype="multipart/form-data" class="flex items-center">
                    @csrf
                    <input type="file" name="file" id="import-file" class="hidden" accept=".xlsx,.xls,.csv">
                    <button type="button" onclick="document.getElementById('import-file').click()" class="w-full sm:w-auto bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition-colors duration-200">
                        <i class="fas fa-file-excel mr-2"></i>Import Excel
                    </button>
                </form>
                <a href="{{ route('laporan.export.pdf') }}" class="w-full sm:w-auto bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition-colors duration-200 text-center inline-block">
                    <i class="fas fa-file-pdf mr-2"></i>Export PDF
                </a>
                <a href="{{ route('laporan.export.excel') }}" class="w-full sm:w-auto bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition-colors duration-200 text-center inline-block">
                    <i class="fas fa-file-excel mr-2"></i>Export Excel
                </a>
            </div>
        </div>
    </div>
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm text-gray-600 mb-1">Total Aspirasi</p>
                    <p class="text-xl md:text-2xl font-bold text-gray-800">{{ $aspirasis->total() }}</p>
                    <p class="text-xs text-blue-600 mt-2">
                        <i class="fas fa-chart-line"></i> Semua data
                    </p>
                </div>
                <div class="w-10 h-10 md:w-12 md:h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-file-alt text-blue-600 text-lg md:text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm text-gray-600 mb-1">Pending</p>
                    <p class="text-xl md:text-2xl font-bold text-gray-800">{{ $aspirasis->where('status', 'pending')->count() }}</p>
                    <p class="text-xs text-yellow-600 mt-2">
                        <i class="fas fa-clock"></i> Menunggu
                    </p>
                </div>
                <div class="w-10 h-10 md:w-12 md:h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-hourglass-half text-yellow-600 text-lg md:text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm text-gray-600 mb-1">Disetujui</p>
                    <p class="text-xl md:text-2xl font-bold text-gray-800">{{ $aspirasis->where('status', 'approved')->count() }}</p>
                    <p class="text-xs text-green-600 mt-2">
                        <i class="fas fa-check-circle"></i> Selesai
                    </p>
                </div>
                <div class="w-10 h-10 md:w-12 md:h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check text-green-600 text-lg md:text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm text-gray-600 mb-1">Ditolak</p>
                    <p class="text-xl md:text-2xl font-bold text-gray-800">{{ $aspirasis->where('status', 'rejected')->count() }}</p>
                    <p class="text-xs text-red-600 mt-2">
                        <i class="fas fa-times-circle"></i> Batal
                    </p>
                </div>
                <div class="w-10 h-10 md:w-12 md:h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-times text-red-600 text-lg md:text-xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Laporan Table -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-4 md:px-6 py-3 md:py-4 border-b border-gray-200">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <h3 class="text-base md:text-lg font-semibold text-gray-800">Daftar Aspirasi</h3>
                <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                    <!-- Search Form -->
                    <form action="{{ route('laporan.index') }}" method="get" class="flex items-center space-x-2">
                        <div class="relative">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request()->get('search') }}"
                                   placeholder="Cari aspirasi..." 
                                   class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full sm:w-64">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NISN</th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aspirasi</th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-4 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($aspirasis as $index => $aspirasi)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $aspirasis->firstItem() + $index }}</td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $aspirasi->siswa->nama ?? '-' }}</td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $aspirasi->siswa->nisn ?? '-' }}</td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $aspirasi->kategori->nama ?? '-' }}</td>
                        <td class="px-4 md:px-6 py-4 text-sm text-gray-900">{{ Str::limit($aspirasi->judul, 50) }}</td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $aspirasi->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm">
                            @if($aspirasi->status == 'pending')
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-clock mr-1"></i>Pending
                                </span>
                            @elseif($aspirasi->status == 'approved')
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-check mr-1"></i>Disetujui
                                </span>
                            @elseif($aspirasi->status == 'rejected')
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    <i class="fas fa-times mr-1"></i>Ditolak
                                </span>
                            @else
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    {{ $aspirasi->status ?? '-' }}
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 md:px-6 py-8 text-center text-sm text-gray-500">
                            <i class="fas fa-inbox fa-2x text-gray-300 mb-2"></i>
                            <p>Tidak ada data aspirasi</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-4 md:px-6 py-3 md:py-4 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="text-sm text-gray-700">
                    <span class="font-medium">{{ $aspirasis->firstItem() }}</span> 
                    sampai 
                    <span class="font-medium">{{ $aspirasis->lastItem() }}</span> 
                    dari 
                    <span class="font-medium">{{ $aspirasis->total() }}</span> data
                </div>
                {{ $aspirasis->links() }}
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('import-file').addEventListener('change', function(e) {
    if (e.target.files.length > 0) {
        e.target.form.submit();
    }
});
</script>
@endsection
