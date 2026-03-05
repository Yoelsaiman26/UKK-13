@extends('layouts.app')

@section('title', 'Dashboard - Pengaduan Suara Sarana Sekolah')

@section('content')
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-6 text-white">
        <h2 class="text-2xl font-bold mb-2">Selamat Datang di Dashboard Pengaduan</h2>
        <p class="text-blue-100">Sistem Pengaduan Suara Sarana Sekolah - Kelola semua pengaduan sarana dan prasarana sekolah dengan mudah</p>
    </div>
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
        <!-- Total Pengaduan -->
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm text-gray-600 mb-1">Total Pengaduan</p>
                    <p class="text-xl sm:text-2xl font-bold text-gray-800">156</p>
                    <p class="text-xs text-green-600 mt-2">
                        <i class="fas fa-arrow-up"></i> 12% dari bulan lalu
                    </p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 rounded-lg flex items-center justify-center ml-3">
                    <i class="fas fa-comment-dots text-blue-600 text-lg sm:text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Pengaduan Menunggu -->
        <div class="bg-white rounded-lg shadow p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm text-gray-600 mb-1">Menunggu Proses</p>
                    <p class="text-xl sm:text-2xl font-bold text-gray-800">23</p>
                    <p class="text-xs text-orange-600 mt-2">
                        <i class="fas fa-clock"></i> Perlu ditindak
                    </p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-orange-100 rounded-lg flex items-center justify-center ml-3">
                    <i class="fas fa-hourglass-half text-orange-600 text-lg sm:text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Sedang Diproses -->
        <div class="bg-white rounded-lg shadow p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm text-gray-600 mb-1">Sedang Diproses</p>
                    <p class="text-xl sm:text-2xl font-bold text-gray-800">18</p>
                    <p class="text-xs text-blue-600 mt-2">
                        <i class="fas fa-spinner"></i> Dalam proses
                    </p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 rounded-lg flex items-center justify-center ml-3">
                    <i class="fas fa-tools text-blue-600 text-lg sm:text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Selesai -->
        <div class="bg-white rounded-lg shadow p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm text-gray-600 mb-1">Selesai</p>
                    <p class="text-xl sm:text-2xl font-bold text-gray-800">115</p>
                    <p class="text-xs text-green-600 mt-2">
                        <i class="fas fa-check-circle"></i> 73.7% selesai
                    </p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-green-100 rounded-lg flex items-center justify-center ml-3">
                    <i class="fas fa-check text-green-600 text-lg sm:text-xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
        <!-- Pengaduan Chart -->
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <h3 class="text-base md:text-lg font-semibold text-gray-800 mb-3 md:mb-4">Trend Pengaduan 6 Bulan Terakhir</h3>
            <div class="h-48 md:h-64 flex items-center justify-center bg-gray-50 rounded">
                <div class="text-center">
                    <i class="fas fa-chart-line text-3xl md:text-4xl text-gray-400 mb-2"></i>
                    <p class="text-sm md:text-base text-gray-500">Chart akan ditampilkan di sini</p>
                </div>
            </div>
        </div>
        
        <!-- Kategori Pengaduan -->
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <h3 class="text-base md:text-lg font-semibold text-gray-800 mb-3 md:mb-4">Pengaduan per Kategori</h3>
            <div class="space-y-2 md:space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2 md:space-x-3">
                        <div class="w-2 h-2 md:w-3 md:h-3 bg-blue-500 rounded-full"></div>
                        <span class="text-xs md:text-sm text-gray-700">Ruang Kelas</span>
                    </div>
                    <span class="text-xs md:text-sm font-medium">45</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2 md:space-x-3">
                        <div class="w-2 h-2 md:w-3 md:h-3 bg-green-500 rounded-full"></div>
                        <span class="text-xs md:text-sm text-gray-700">Laboratorium</span>
                    </div>
                    <span class="text-xs md:text-sm font-medium">28</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2 md:space-x-3">
                        <div class="w-2 h-2 md:w-3 md:h-3 bg-yellow-500 rounded-full"></div>
                        <span class="text-xs md:text-sm text-gray-700">Perpustakaan</span>
                    </div>
                    <span class="text-xs md:text-sm font-medium">32</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2 md:space-x-3">
                        <div class="w-2 h-2 md:w-3 md:h-3 bg-red-500 rounded-full"></div>
                        <span class="text-xs md:text-sm text-gray-700">Sarana Olahraga</span>
                    </div>
                    <span class="text-xs md:text-sm font-medium">51</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Pengaduan Table -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-4 md:px-6 py-3 md:py-4 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <h3 class="text-base md:text-lg font-semibold text-gray-800">Pengaduan Terbaru</h3>
                <a href="{{ route('pengaduan.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium inline-flex items-center">
                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[500px]">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelapor</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Judul</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-900">#001</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-900">Ahmad Rizki</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-900">Ruang Kelas</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 text-sm text-gray-900 hidden sm:table-cell">Kursi rusak di kelas X-IPA 2</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Menunggu
                            </span>
                        </td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500">2 jam lalu</td>
                    </tr>
                    <tr>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-900">#002</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-900">Siti Nurhaliza</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-900">Laboratorium</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 text-sm text-gray-900 hidden sm:table-cell">Mikroskop tidak berfungsi</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                Proses
                            </span>
                        </td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500">5 jam lalu</td>
                    </tr>
                    <tr>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-900">#003</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-900">Budi Santoso</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-900">Perpustakaan</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 text-sm text-gray-900 hidden sm:table-cell">AC ruang perpustakaan mati</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Selesai
                            </span>
                        </td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500">1 hari lalu</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
