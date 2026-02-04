@extends('layouts.app')

@section('title', 'Edit Kategori - Pengaduan Suara Sarana Sekolah')

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
                    <h2 class="text-2xl font-bold mb-2">Edit Kategori</h2>
                    <p class="text-blue-100">Perbarui informasi kategori "{{ $kategori->nama }}"</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('kategori.index') }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
    
    <!-- Form Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Form -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Informasi Kategori</h3>
                    <p class="text-sm text-gray-600 mt-1">Perbarui informasi dasar kategori pengaduan</p>
                </div>
                
                <form action="{{ route('kategori.update', $kategori) }}" method="post" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <!-- Nama Kategori -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Kategori <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="nama" 
                               name="nama" 
                               value="{{ $kategori->nama }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
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
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                  placeholder="Jelaskan jenis pengaduan yang termasuk dalam kategori ini...">{{ $kategori->deskripsi }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Deskripsi membantu pengguna memahami jenis pengaduan yang tepat</p>
                    </div>
                    
                    <!-- Icon Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pilih Icon <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-6 gap-3">
                            <button type="button" class="icon-option p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-door-open" {{ $kategori->icon === 'fa-door-open' ? 'style="border-color: #3B82F6; background-color: #EFF6FF;"' : '' }}>
                                <i class="fas fa-door-open text-xl text-gray-600"></i>
                            </button>
                            <button type="button" class="icon-option p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-flask" {{ $kategori->icon === 'fa-flask' ? 'style="border-color: #3B82F6; background-color: #EFF6FF;"' : '' }}>
                                <i class="fas fa-flask text-xl text-gray-600"></i>
                            </button>
                            <button type="button" class="icon-option p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-book" {{ $kategori->icon === 'fa-book' ? 'style="border-color: #3B82F6; background-color: #EFF6FF;"' : '' }}>
                                <i class="fas fa-book text-xl text-gray-600"></i>
                            </button>
                            <button type="button" class="icon-option p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-football-ball" {{ $kategori->icon === 'fa-football-ball' ? 'style="border-color: #3B82F6; background-color: #EFF6FF;"' : '' }}>
                                <i class="fas fa-football-ball text-xl text-gray-600"></i>
                            </button>
                            <button type="button" class="icon-option p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-utensils" {{ $kategori->icon === 'fa-utensils' ? 'style="border-color: #3B82F6; background-color: #EFF6FF;"' : '' }}>
                                <i class="fas fa-utensils text-xl text-gray-600"></i>
                            </button>
                            <button type="button" class="icon-option p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-toilet" {{ $kategori->icon === 'fa-toilet' ? 'style="border-color: #3B82F6; background-color: #EFF6FF;"' : '' }}>
                                <i class="fas fa-toilet text-xl text-gray-600"></i>
                            </button>
                            <button type="button" class="icon-option p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-parking" {{ $kategori->icon === 'fa-parking' ? 'style="border-color: #3B82F6; background-color: #EFF6FF;"' : '' }}>
                                <i class="fas fa-parking text-xl text-gray-600"></i>
                            </button>
                            <button type="button" class="icon-option p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-wifi" {{ $kategori->icon === 'fa-wifi' ? 'style="border-color: #3B82F6; background-color: #EFF6FF;"' : '' }}>
                                <i class="fas fa-wifi text-xl text-gray-600"></i>
                            </button>
                            <button type="button" class="icon-option p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-tint" {{ $kategori->icon === 'fa-tint' ? 'style="border-color: #3B82F6; background-color: #EFF6FF;"' : '' }}>
                                <i class="fas fa-tint text-xl text-gray-600"></i>
                            </button>
                            <button type="button" class="icon-option p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-lightbulb" {{ $kategori->icon === 'fa-lightbulb' ? 'style="border-color: #3B82F6; background-color: #EFF6FF;"' : '' }}>
                                <i class="fas fa-lightbulb text-xl text-gray-600"></i>
                            </button>
                            <button type="button" class="icon-option p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-chair" {{ $kategori->icon === 'fa-chair' ? 'style="border-color: #3B82F6; background-color: #EFF6FF;"' : '' }}>
                                <i class="fas fa-chair text-xl text-gray-600"></i>
                            </button>
                            <button type="button" class="icon-option p-3 border-2 border-gray-200 rounded-lg hover:border-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors" data-icon="fa-tools" {{ $kategori->icon === 'fa-tools' ? 'style="border-color: #3B82F6; background-color: #EFF6FF;"' : '' }}>
                                <i class="fas fa-tools text-xl text-gray-600"></i>
                            </button>
                        </div>
                        <input type="hidden" id="selectedIcon" name="icon" value="{{ $kategori->icon ?? 'fa-door-open' }}" required>
                        <p class="mt-1 text-xs text-gray-500">Pilih icon yang mewakili kategori ini</p>
                    </div>
                    
                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Status Kategori
                        </label>
                        <div class="flex items-center space-x-6">
                            <label class="flex items-center">
                                <input type="radio" name="status" value="1" {{ $kategori->status ? 'checked' : '' }} class="mr-2 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-gray-700">Aktif</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="status" value="0" {{ !$kategori->status ? 'checked' : '' }} class="mr-2 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-gray-700">Non-Aktif</span>
                            </label>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Kategori aktif akan muncul di menu pengaduan</p>
                    </div>
                    
                    <!-- Info Kategori -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Informasi Kategori</h4>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-500">ID:</span>
                                <span class="ml-2 font-medium">#{{ str_pad($kategori->id, 3, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Dibuat:</span>
                                <span class="ml-2 font-medium">{{ $kategori->created_at->format('d/m/Y') }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Status Saat Ini:</span>
                                <span class="ml-2">
                                    @if($kategori->status)
                                        <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Aktif</span>
                                    @else
                                        <span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Non-Aktif</span>
                                    @endif
                                </span>
                            </div>
                            <div>
                                <span class="text-gray-500">Terakhir Update:</span>
                                <span class="ml-2 font-medium">{{ $kategori->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-600">
                                <i class="fas fa-info-circle mr-1"></i>
                                Perubahan akan langsung diterapkan setelah menyimpan
                            </div>
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('kategori.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                    <i class="fas fa-times mr-2"></i>Batal
                                </a>
                                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<form id="deleteForm" action="{{ route('kategori.destroy', $kategori) }}" method="post" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Icon selection
    const iconOptions = document.querySelectorAll('.icon-option');
    const selectedIconInput = document.getElementById('selectedIcon');
    
    iconOptions.forEach(option => {
        option.addEventListener('click', function() {
            iconOptions.forEach(opt => {
                opt.classList.remove('border-blue-500', 'bg-blue-50');
                opt.classList.add('border-gray-200');
                opt.style.borderColor = '';
                opt.style.backgroundColor = '';
            });
            this.classList.remove('border-gray-200');
            this.classList.add('border-blue-500', 'bg-blue-50');
            
            // Update hidden input with selected icon
            const icon = this.getAttribute('data-icon');
            selectedIconInput.value = icon;
        });
    });
});

function confirmDelete() {
    if (confirm('Apakah Anda yakin ingin menghapus kategori "{{ $kategori->nama }}"? Tindakan ini tidak dapat dibatalkan.')) {
        document.getElementById('deleteForm').submit();
    }
}
</script>
@endsection
