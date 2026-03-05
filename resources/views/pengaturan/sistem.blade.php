@extends('layouts.app')

@section('title', 'Pengaturan Sistem - Pengaduan Suara Sarana Sekolah')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-4 sm:p-6 text-white">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold mb-2">Pengaturan Sistem</h2>
                <p class="text-blue-100 text-sm sm:text-base">Kelola konfigurasi sistem aplikasi</p>
            </div>
        </div>
    </div>
    
    <!-- Settings Content -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-4 sm:px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Konfigurasi Sistem</h3>
        </div>
        
        <div class="p-4 sm:p-6">
            <div class="space-y-6">
                <!-- General Settings -->
                <div>
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Pengaturan Umum</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Aplikasi
                            </label>
                            <input type="text" 
                                   value="Pengaduan Sarana Sekolah" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Versi
                            </label>
                            <input type="text" 
                                   value="1.0.0" 
                                   readonly
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50">
                        </div>
                    </div>
                </div>
                
                <!-- Email Settings -->
                <div>
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Pengaturan Email</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Email Administrator
                            </label>
                            <input type="email" 
                                   value="admin@smkbinaalam.sch.id" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Email Notifikasi
                            </label>
                            <input type="email" 
                                   value="notif@smkbinaalam.sch.id" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>
                
                <!-- System Settings -->
                <div>
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Pengaturan Sistem</h4>
                    <div class="space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="flex-1">
                                <label class="text-sm font-medium text-gray-700">Notifikasi Email</label>
                                <p class="text-sm text-gray-500">Aktifkan notifikasi email untuk pengaduan baru</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="flex-1">
                                <label class="text-sm font-medium text-gray-700">Mode Maintenance</label>
                                <p class="text-sm text-gray-500">Nonaktifkan akses pengguna untuk maintenance</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-3 pt-6 border-t border-gray-200">
                    <button class="w-full sm:w-auto px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        <i class="fas fa-times mr-2"></i>Batal
                    </button>
                    <button class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        <i class="fas fa-save mr-2"></i>Simpan Pengaturan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
