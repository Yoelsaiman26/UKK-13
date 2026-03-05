@extends('layouts.app')

@section('title', 'Tambah Kategori - Pengaduan Suara Sarana Sekolah')

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
            <div class="flex items-center space-x-3 md:space-x-4">
                <div>
                    <h2 class="text-xl md:text-2xl font-bold mb-2">Tambah Kategori Baru</h2>
                    <p class="text-blue-100 text-sm md:text-base">Tambahkan kategori baru untuk sistem pengaduan sarana sekolah</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('kategori.index') }}" class="w-full sm:w-auto bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
    
    <!-- Form Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
        <!-- Main Form -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-lg shadow">
                <div class="px-4 md:px-6 py-3 md:py-4 border-b border-gray-200">
                    <h3 class="text-base md:text-lg font-semibold text-gray-800">Informasi Kategori</h3>
                    <p class="text-sm text-gray-600 mt-1">Isi informasi dasar kategori pengaduan</p>
                </div>
                
                <form action="{{ route('kategori.store') }}" method="post" class="p-4 md:p-6 space-y-4 md:space-y-6">
                    @csrf
                    <!-- Nama Kategori -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Kategori <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="nama" 
                               name="nama" 
                               class="w-full px-3 md:px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm md:text-base"
                               placeholder="Contoh: Ruang Kelas, Laboratorium, Perpustakaan"
                               required>
                        <p class="mt-1 text-xs text-gray-500">Nama kategori akan ditampilkan di menu pengaduan</p>
                    </div>
                    
                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi
                        </label>
                        <textarea id="deskripsi" 
                                  name="deskripsi" 
                                  rows="4" 
                                  class="w-full px-3 md:px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none text-sm md:text-base"
                                  placeholder="Jelaskan jenis pengaduan yang termasuk dalam kategori ini..."></textarea>
                        <p class="mt-1 text-xs text-gray-500">Deskripsi membantu pengguna memahami jenis pengaduan yang tepat</p>
                    </div>
                    
                    <!-- Icon Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pilih Icon <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-2 md:gap-3">
                            <button type="button" class="icon-option p-2 md:p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-door-open">
                                <i class="fas fa-door-open text-lg md:text-xl text-gray-600"></i>
                            </button>
                            <button type="button" class="icon-option p-2 md:p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-flask">
                                <i class="fas fa-flask text-lg md:text-xl text-gray-600"></i>
                            </button>
                            <button type="button" class="icon-option p-2 md:p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-book">
                                <i class="fas fa-book text-lg md:text-xl text-gray-600"></i>
                            </button>
                            <button type="button" class="icon-option p-2 md:p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-football-ball">
                                <i class="fas fa-football-ball text-lg md:text-xl text-gray-600"></i>
                            </button>
                            <button type="button" class="icon-option p-2 md:p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-utensils">
                                <i class="fas fa-utensils text-lg md:text-xl text-gray-600"></i>
                            </button>
                            <button type="button" class="icon-option p-2 md:p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-toilet">
                                <i class="fas fa-toilet text-lg md:text-xl text-gray-600"></i>
                            </button>
                            <button type="button" class="icon-option p-2 md:p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-parking">
                                <i class="fas fa-parking text-lg md:text-xl text-gray-600"></i>
                            </button>
                            <button type="button" class="icon-option p-2 md:p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-wifi">
                                <i class="fas fa-wifi text-lg md:text-xl text-gray-600"></i>
                            </button>
                            <button type="button" class="icon-option p-2 md:p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-tint">
                                <i class="fas fa-tint text-lg md:text-xl text-gray-600"></i>
                            </button>
                            <button type="button" class="icon-option p-2 md:p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-lightbulb">
                                <i class="fas fa-lightbulb text-lg md:text-xl text-gray-600"></i>
                            </button>
                            <button type="button" class="icon-option p-2 md:p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-chair">
                                <i class="fas fa-chair text-lg md:text-xl text-gray-600"></i>
                            </button>
                            <button type="button" class="icon-option p-2 md:p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-tools">
                                <i class="fas fa-tools text-lg md:text-xl text-gray-600"></i>
                            </button>
                        </div>
                        <input type="hidden" id="selectedIcon" name="icon" value="fa-door-open" required>
                        <p class="mt-1 text-xs text-gray-500">Pilih icon yang mewakili kategori ini</p>
                    </div>
                    
                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Status Kategori
                        </label>
                        <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-2 sm:space-y-0">
                            <label class="flex items-center">
                                <input type="radio" name="status" value="1" checked class="mr-2 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-gray-700">Aktif</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="status" value="0" class="mr-2 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-gray-700">Non-Aktif</span>
                            </label>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Kategori aktif akan muncul di menu pengaduan</p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4 md:p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="text-sm text-gray-600">
                                <i class="fas fa-info-circle mr-1"></i>
                                Pastikan semua data sudah terisi dengan benar sebelum menyimpan
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-3 gap-2">
                                <a href="{{ route('kategori.index') }}" class="w-full sm:w-auto px-4 md:px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                    <i class="fas fa-times mr-2"></i>Batal
                                </a>
                                <button type="submit" class="w-full sm:w-auto px-4 md:px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                    <i class="fas fa-save mr-2"></i>Simpan Kategori
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Icon selection
    const iconOptions = document.querySelectorAll('.icon-option');
    const selectedIconInput = document.getElementById('selectedIcon');
    
    // Set first icon as selected by default
    iconOptions[0].classList.add('border-blue-500', 'bg-blue-50');
    
    iconOptions.forEach(option => {
        option.addEventListener('click', function() {
            iconOptions.forEach(opt => {
                opt.classList.remove('border-blue-500', 'bg-blue-50');
                opt.classList.add('border-gray-200');
            });
            this.classList.remove('border-gray-200');
            this.classList.add('border-blue-500', 'bg-blue-50');
            
            // Update hidden input with selected icon
            const icon = this.getAttribute('data-icon');
            selectedIconInput.value = icon;
        });
    });
});
</script>
@endsection