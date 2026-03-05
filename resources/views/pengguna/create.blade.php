@extends('layouts.app')

@section('title', 'Tambah Pengguna - Suara Sarana Sekolah')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-4 md:p-6 text-white">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl md:text-2xl font-bold mb-2">Tambah Pengguna</h2>
                <p class="text-blue-100 text-sm md:text-base">Tambahkan pengguna baru ke dalam sistem</p>
            </div>
            <a href="#" class="w-full sm:w-auto bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>
    
    <!-- Form Section -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-4 py-3 border-b border-gray-200">
            <h3 class="text-base md:text-lg font-semibold text-gray-800">Form Pengguna</h3>
        </div>
        
        <form id="createUserForm" class="px-4 py-6 space-y-6">
            @csrf
            
            <!-- Informasi Personal -->
            <div class="space-y-4">
                <h4 class="text-sm font-medium text-gray-900 border-b pb-2">Informasi Personal</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="nama" 
                               name="nama" 
                               required
                               placeholder="Masukkan nama lengkap"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <p class="mt-1 text-xs text-gray-500">Nama lengkap pengguna</p>
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               required
                               placeholder="email@example.com"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <p class="mt-1 text-xs text-gray-500">Email untuk login dan notifikasi</p>
                    </div>
                </div>
            </div>
            
            <!-- Informasi Akun -->
            <div class="space-y-4">
                <h4 class="text-sm font-medium text-gray-900 border-b pb-2">Informasi Akun</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   required
                                   placeholder="Masukkan password"
                                   class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <button type="button" 
                                    onclick="togglePassword('password')"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i id="password-icon" class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                            </button>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter</p>
                    </div>
                    
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                            Konfirmasi Password <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   required
                                   placeholder="Konfirmasi password"
                                   class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <button type="button" 
                                    onclick="togglePassword('password_confirmation')"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i id="password_confirmation-icon" class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                            </button>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Ulangi password yang sama</p>
                    </div>
                </div>
            </div>
            
            <!-- Pengaturan Akun -->
            <div class="space-y-4">
                <h4 class="text-sm font-medium text-gray-900 border-b pb-2">Pengaturan Akun</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-1">
                            Role/Level <span class="text-red-500">*</span>
                        </label>
                        <select id="role" 
                                name="role" 
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih Role</option>
                            <option value="admin">Administrator</option>
                            <option value="guru">Guru</option>
                            <option value="staff">Staff</option>
                        </select>
                        <p class="mt-1 text-xs text-gray-500">Hak akses pengguna dalam sistem</p>
                    </div>
                    
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                            Status Akun <span class="text-red-500">*</span>
                        </label>
                        <select id="status" 
                                name="status" 
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="1">Aktif</option>
                            <option value="0">Non-Aktif</option>
                        </select>
                        <p class="mt-1 text-xs text-gray-500">Status aktif/non-aktif pengguna</p>
                    </div>
                </div>
            </div>
            
            <!-- Additional Information -->
            <div class="space-y-4">
                <h4 class="text-sm font-medium text-gray-900 border-b pb-2">Informasi Tambahan</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1">
                            Nomor Telepon
                        </label>
                        <input type="tel" 
                               id="telepon" 
                               name="telepon" 
                               placeholder="08123456789"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <p class="mt-1 text-xs text-gray-500">Opsional</p>
                    </div>
                    
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">
                            Alamat
                        </label>
                        <textarea id="alamat" 
                                  name="alamat" 
                                  rows="1"
                                  placeholder="Masukkan alamat lengkap"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                        <p class="mt-1 text-xs text-gray-500">Opsional</p>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="#" class="w-full sm:w-auto px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200 text-center font-medium">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium">
                    <i class="fas fa-save mr-2"></i>Simpan Pengguna
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '-icon');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

document.getElementById('createUserForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Validate password match
    const password = document.getElementById('password').value;
    const passwordConfirmation = document.getElementById('password_confirmation').value;
    
    if (password !== passwordConfirmation) {
        Swal.fire({
            icon: 'error',
            title: 'Password Tidak Sama',
            text: 'Password dan konfirmasi password harus sama!',
            confirmButtonText: 'OK'
        });
        return;
    }
    
    // Validate password length
    if (password.length < 8) {
        Swal.fire({
            icon: 'error',
            title: 'Password Terlalu Pendek',
            text: 'Password minimal harus 8 karakter!',
            confirmButtonText: 'OK'
        });
        return;
    }
    
    // Show loading
    Swal.fire({
        title: 'Menyimpan...',
        text: 'Sedang menyimpan data pengguna',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    // Simulate API call
    setTimeout(() => {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Pengguna berhasil ditambahkan',
            timer: 2000,
            showConfirmButton: false
        }).then(() => {
            // Redirect to index page
            window.location.href = '#';
        });
    }, 1500);
});

// Real-time validation
document.getElementById('email').addEventListener('blur', function() {
    const email = this.value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (email && !emailRegex.test(email)) {
        this.classList.add('border-red-500');
        this.classList.remove('border-gray-300');
    } else {
        this.classList.remove('border-red-500');
        this.classList.add('border-gray-300');
    }
});

document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const strengthIndicator = document.getElementById('password-strength');
    
    if (password.length > 0) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;
        if (password.match(/[^a-zA-Z0-9]/)) strength++;
        
        let strengthText = '';
        let strengthColor = '';
        
        switch(strength) {
            case 0:
            case 1:
                strengthText = 'Lemah';
                strengthColor = 'text-red-600';
                break;
            case 2:
                strengthText = 'Sedang';
                strengthColor = 'text-yellow-600';
                break;
            case 3:
                strengthText = 'Kuat';
                strengthColor = 'text-green-600';
                break;
            case 4:
                strengthText = 'Sangat Kuat';
                strengthColor = 'text-green-700';
                break;
        }
        
        if (!strengthIndicator) {
            const indicator = document.createElement('span');
            indicator.id = 'password-strength';
            indicator.className = `text-xs ${strengthColor} ml-2`;
            indicator.textContent = strengthText;
            this.parentNode.appendChild(indicator);
        } else {
            strengthIndicator.textContent = strengthText;
            strengthIndicator.className = `text-xs ${strengthColor} ml-2`;
        }
    } else if (strengthIndicator) {
        strengthIndicator.remove();
    }
});
</script>
@endsection