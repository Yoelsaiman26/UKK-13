@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-user-circle text-blue-600 mr-2"></i>
                    Profil Saya
                </h1>
                @if($isAdmin)
                    <button onclick="toggleEditMode()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
                        <i class="fas fa-edit mr-2"></i>
                        <span id="editButtonText">Edit Profil</span>
                    </button>
                @endif
            </div>
        </div>

        <!-- Profile Card -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Profile Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-6">
                <div class="flex items-center space-x-4">
                    <div class="h-20 w-20 bg-white rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-blue-600 text-3xl"></i>
                    </div>
                    <div class="text-white">
                        <h2 class="text-xl font-bold">{{ $user->name ?? $user->nama }}</h2>
                        <p class="text-blue-100">
                            @if($isAdmin)
                                Administrator
                            @else
                                Siswa ({{ $user->nisn }})
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Profile Form -->
            <div class="p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form id="profileForm" action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Admin Fields -->
                    @if($isAdmin)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-user mr-1"></i>
                                    Nama Lengkap
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name"
                                       value="{{ $user->name }}" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       disabled>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-envelope mr-1"></i>
                                    Email
                                </label>
                                <input type="email" 
                                       name="email" 
                                       id="email"
                                       value="{{ $user->email }}" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       disabled>
                            </div>
                        </div>

                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-shield-alt mr-1"></i>
                                Role
                            </label>
                            <input type="text" 
                                   value="Administrator" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50"
                                   readonly>
                        </div>
                    @endif

                    <!-- Student Fields -->
                    @if($isStudent)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-user mr-1"></i>
                                    Nama Lengkap
                                </label>
                                <input type="text" 
                                       value="{{ $user->nama }}" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50"
                                       readonly>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-id-card mr-1"></i>
                                    NISN
                                </label>
                                <input type="text" 
                                       value="{{ $user->nisn }}" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50"
                                       readonly>
                            </div>
                        </div>

                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-shield-alt mr-1"></i>
                                Role
                            </label>
                            <input type="text" 
                                   value="Siswa" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50"
                                   readonly>
                        </div>

                        <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <p class="text-sm text-yellow-800">
                                <i class="fas fa-info-circle mr-2"></i>
                                Profil siswa bersifat read-only. Untuk perubahan data, silakan hubungi administrator.
                            </p>
                        </div>
                    @endif

                    <!-- Save Button (Admin Only) -->
                    @if($isAdmin)
                        <div class="mt-8 flex justify-end space-x-3" id="saveButtonContainer" style="display: none;">
                            <button type="button" 
                                    onclick="cancelEdit()" 
                                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                                Batal
                            </button>
                            <button type="submit" 
                                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition duration-200">
                                <i class="fas fa-save mr-2"></i>
                                Simpan Perubahan
                            </button>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="mt-6 bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                Informasi Tambahan
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-600">Terakhir login:</p>
                    <p class="font-medium">{{ now()->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Status Akun:</p>
                    <p class="font-medium text-green-600">
                        <i class="fas fa-check-circle mr-1"></i>
                        Aktif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let isEditMode = false;

function toggleEditMode() {
    isEditMode = !isEditMode;
    const nameField = document.getElementById('name');
    const emailField = document.getElementById('email');
    const editButton = document.getElementById('editButtonText');
    const saveButtonContainer = document.getElementById('saveButtonContainer');

    if (isEditMode) {
        nameField.disabled = false;
        emailField.disabled = false;
        editButton.textContent = 'Batal Edit';
        saveButtonContainer.style.display = 'flex';
        
        nameField.classList.add('bg-white');
        emailField.classList.add('bg-white');
    } else {
        nameField.disabled = true;
        emailField.disabled = true;
        editButton.textContent = 'Edit Profil';
        saveButtonContainer.style.display = 'none';
        
        nameField.classList.remove('bg-white');
        emailField.classList.remove('bg-white');
    }
}

function cancelEdit() {
    // Reset form to original values
    document.getElementById('profileForm').reset();
    toggleEditMode();
}
</script>
@endsection
