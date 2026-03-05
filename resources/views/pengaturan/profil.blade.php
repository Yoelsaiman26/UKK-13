@extends('layouts.app')

@section('title', 'Profil Sekolah - Pengaduan Suara Sarana Sekolah')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-4 sm:p-6 text-white">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold mb-2">Profil Sekolah</h2>
                <p class="text-blue-100 text-sm sm:text-base">Kelola informasi profil sekolah</p>
            </div>
        </div>
    </div>
    
    <!-- Profile Content -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-4 sm:px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Informasi Sekolah</h3>
        </div>
        
        <div class="p-4 sm:p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Identitas Sekolah</h4>
                    <div class="space-y-3">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Nama Sekolah</label>
                            <p class="text-gray-900 break-words">SMK Bina ALam</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">NPSN</label>
                            <p class="text-gray-900 break-words">12345678</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">NSS</label>
                            <p class="text-gray-900 break-words">123456780001</p>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Kontak</h4>
                    <div class="space-y-3">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Alamat</label>
                            <p class="text-gray-900 break-words">Jl. Pendidikan No. 123, Jakarta Selatan</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Telepon</label>
                            <p class="text-gray-900 break-words">(021) 1234-5678</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Email</label>
                            <p class="text-gray-900 break-words text-sm">info@smkbinaalam.sch.id</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 pt-6 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-3">
                    <button class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        <i class="fas fa-edit mr-2"></i>Edit Profil
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
