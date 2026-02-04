@extends('layouts.app')

@section('title', 'Detail Kategori - Pengaduan Suara Sarana Sekolah')

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
                    <h2 class="text-2xl font-bold mb-2">Detail Kategori</h2>
                    <p class="text-blue-100">Informasi lengkap kategori "{{ $kategori->nama }}"</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('kategori.index') }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition-colors duration-200">
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
                        <!-- Nama Kategori -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Nama Kategori</label>
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas {{ $kategori->icon ?? 'fa-door-open' }} text-blue-600"></i>
                                </div>
                                <span class="text-lg font-medium text-gray-900">{{ $kategori->nama }}</span>
                            </div>
                        </div>
                        
                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Status</label>
                            <div>
                                @if($kategori->status)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-2"></i>Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-2"></i>Non-Aktif
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- ID Kategori -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">ID Kategori</label>
                            <div class="flex items-center">
                                <span class="text-lg font-medium text-gray-900">#{{ str_pad($kategori->id, 3, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>
                        
                        <!-- Deskripsi -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-500 mb-2">Deskripsi</label>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-700">{{ $kategori->deskripsi ?: 'Tidak ada deskripsi' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="space-y-6">
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
                            <span>{{ $kategori->created_at->format('d F Y, H:i') }}</span>
                        </div>
                        <div class="text-xs text-gray-500 mt-1">{{ $kategori->created_at->diffForHumans() }}</div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Terakhir diperbarui</label>
                        <div class="flex items-center text-gray-900">
                            <i class="fas fa-calendar-edit mr-2 text-gray-400"></i>
                            <span>{{ $kategori->updated_at->format('d F Y, H:i') }}</span>
                        </div>
                        <div class="text-xs text-gray-500 mt-1">{{ $kategori->updated_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection