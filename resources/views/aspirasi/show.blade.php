@extends('layouts.app')

@section('title', 'Detail Aspirasi - Pengaduan Suara Sarana Sekolah')

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
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-eye text-3xl text-white"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold mb-2">Detail Aspirasi</h2>
                    <p class="text-purple-100">Informasi lengkap aspirasi "{{ $aspirasi->judul }}"</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('aspirasi.index') }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Detail Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Info Card -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Informasi Dasar</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Judul Aspirasi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Judul Aspirasi</label>
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-eye text-blue-600"></i>
                                </div>
                                <span class="text-lg font-medium text-gray-900">{{ $aspirasi->judul }}</span>
                            </div>
                        </div>
                        
                        <!-- Kategori -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Kategori</label>
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas {{ $aspirasi->kategori->icon ?? 'fa-door-open' }} text-blue-600"></i>
                                </div>
                                <span class="text-lg font-medium text-gray-900">{{ $aspirasi->kategori->nama }}</span>
                            </div>
                        </div>
                        
                        <!-- ID Aspirasi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">ID Aspirasi</label>
                            <div class="flex items-center">
                                <span class="text-lg font-medium text-gray-900">#{{ str_pad($aspirasi->id, 3, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>
                        
                        <!-- NIS Siswa -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">NIS Siswa</label>
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-green-600"></i>
                                </div>
                                <span class="text-lg font-medium text-gray-900">{{ $aspirasi->nis }}</span>
                            </div>
                        </div>
                        
                        <!-- Lokasi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Lokasi</label>
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-map-marker-alt text-red-600"></i>
                                </div>
                                <span class="text-lg font-medium text-gray-900">{{ $aspirasi->lokasi ?: 'Tidak ada lokasi' }}</span>
                            </div>
                        </div>
                        
                        <!-- Nama Siswa -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Nama Siswa</label>
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-graduation-cap text-indigo-600"></i>
                                </div>
                                <span class="text-lg font-medium text-gray-900">{{ $aspirasi->siswa->nama ?? 'Tidak diketahui' }}</span>
                            </div>
                        </div>
                        
                        <!-- Keterangan -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-500 mb-2">Keterangan</label>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-700">{{ $aspirasi->keterangan ?: 'Tidak ada keterangan' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Eye Icon Card -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow text-white p-6">
                <div class="text-center">
                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-eye text-4xl text-white"></i>
                    </div>
                    <h4 class="text-lg font-semibold mb-2">Aspirasi Terpantau</h4>
                    <p class="text-blue-100 text-sm">Setiap aspirasi Anda kami perhatikan dengan seksama</p>
                </div>
            </div>
            
            <!-- Timestamp Info -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Informasi Waktu</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Dibuat pada</label>
                        <div class="flex items-center text-gray-900">
                            <i class="fas fa-calendar-plus mr-2 text-gray-400"></i>
                            <span>{{ $aspirasi->created_at->format('d F Y, H:i') }}</span>
                        </div>
                        <div class="text-xs text-gray-500 mt-1">{{ $aspirasi->created_at->diffForHumans() }}</div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Terakhir diperbarui</label>
                        <div class="flex items-center text-gray-900">
                            <i class="fas fa-calendar-edit mr-2 text-gray-400"></i>
                            <span>{{ $aspirasi->updated_at->format('d F Y, H:i') }}</span>
                        </div>
                        <div class="text-xs text-gray-500 mt-1">{{ $aspirasi->updated_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection