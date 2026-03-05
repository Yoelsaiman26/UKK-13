<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

@extends('layouts.app')

@section('title', 'Pengguna - Suara Sarana Sekolah')

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
            <div>
                <h2 class="text-xl md:text-2xl font-bold mb-2">Manajemen Pengguna</h2>
                <p class="text-blue-100 text-sm md:text-base">Kelola pengguna sistem untuk aplikasi sarana sekolah</p>
            </div>
            <form action="{{ route('pengguna.create') }}" method="get">
                <button class="w-full sm:w-auto bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>Tambah Pengguna
                </button>
            </form>
        </div>
    </div>
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm text-gray-600 mb-1">Total Pengguna</p>
                    <p class="text-xl md:text-2xl font-bold text-gray-800">5</p>
                    <p class="text-xs text-green-600 mt-2">
                        <i class="fas fa-check-circle"></i> Terdaftar
                    </p>
                </div>
                <div class="w-10 h-10 md:w-12 md:h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-blue-600 text-lg md:text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm text-gray-600 mb-1">Pengguna Aktif</p>
                    <p class="text-xl md:text-2xl font-bold text-gray-800">4</p>
                    <p class="text-xs text-green-600 mt-2">
                        <i class="fas fa-arrow-up"></i> 80% aktif
                    </p>
                </div>
                <div class="w-10 h-10 md:w-12 md:h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-toggle-on text-green-600 text-lg md:text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm text-gray-600 mb-1">Pengguna Non-Aktif</p>
                    <p class="text-xl md:text-2xl font-bold text-gray-800">1</p>
                    <p class="text-xs text-orange-600 mt-2">
                        <i class="fas fa-toggle-off"></i> Perlu dicek
                    </p>
                </div>
                <div class="w-10 h-10 md:w-12 md:h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-orange-600 text-lg md:text-xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Pengguna Table -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-4 md:px-6 py-3 md:py-4 border-b border-gray-200">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <h3 class="text-base md:text-lg font-semibold text-gray-800">Daftar Pengguna</h3>
                <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                    <!-- Search Form -->
                    <form action="#" method="get" class="flex items-center space-x-2">
                        <div class="relative">
                            <input type="text" 
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Cari pengguna..." 
                                   class="w-48 md:w-64 px-3 md:px-4 py-2 pl-8 md:pl-10 pr-4 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <i class="fas fa-search absolute left-2.5 md:left-3 top-2.5 text-gray-400 text-sm"></i>
                        </div>
                        <button type="submit" class="px-3 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    
                    <!-- Filter Form -->
                    <form action="#" method="get" class="flex items-center space-x-2">
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        <select name="status" onchange="this.form.submit()" class="px-3 md:px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Status</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </form>
                    
                    <!-- Clear Filters -->
                    @if(request()->hasAny(['search', 'status']))
                        <a href="#" class="px-3 py-2 bg-red-100 text-red-700 text-sm rounded-lg hover:bg-red-200 transition-colors duration-200">
                            <i class="fas fa-times mr-1"></i>Reset
                        </a>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full min-w-[600px]">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Role</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Dibuat</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Static Data Users -->
                    <tr>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-900">#001</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-6 h-6 md:w-8 md:h-8 bg-blue-100 rounded-full flex items-center justify-center mr-2 md:mr-3">
                                    <i class="fas fa-user text-blue-600 text-xs md:text-sm"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Admin User</span>
                            </div>
                        </td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500">admin@sekolah.sch.id</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500 hidden sm:table-cell">Administrator</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Aktif
                            </span>
                        </td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell">2 hari yang lalu</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-1 md:space-x-2">
                                <button onclick="viewUser(1, 'Admin User')" class="text-gray-600 hover:text-gray-900 p-1" title="Detail">
                                    <i class="fas fa-eye text-sm"></i>
                                </button>
                                <button onclick="editUser(1, 'Admin User')" class="text-blue-600 hover:text-blue-900 p-1" title="Edit">
                                    <i class="fas fa-edit text-sm"></i>
                                </button>
                                <button onclick="confirmDelete(1, 'Admin User')" class="text-red-600 hover:text-red-900 p-1" title="Hapus">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-900">#002</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-6 h-6 md:w-8 md:h-8 bg-green-100 rounded-full flex items-center justify-center mr-2 md:mr-3">
                                    <i class="fas fa-user text-green-600 text-xs md:text-sm"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Ahmad Wijaya</span>
                            </div>
                        </td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500">ahmad@sekolah.sch.id</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500 hidden sm:table-cell">Guru</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Aktif
                            </span>
                        </td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell">1 minggu yang lalu</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-1 md:space-x-2">
                                <button onclick="viewUser(2, 'Ahmad Wijaya')" class="text-gray-600 hover:text-gray-900 p-1" title="Detail">
                                    <i class="fas fa-eye text-sm"></i>
                                </button>
                                <button onclick="editUser(2, 'Ahmad Wijaya')" class="text-blue-600 hover:text-blue-900 p-1" title="Edit">
                                    <i class="fas fa-edit text-sm"></i>
                                </button>
                                <button onclick="confirmDelete(2, 'Ahmad Wijaya')" class="text-red-600 hover:text-red-900 p-1" title="Hapus">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-900">#003</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-6 h-6 md:w-8 md:h-8 bg-purple-100 rounded-full flex items-center justify-center mr-2 md:mr-3">
                                    <i class="fas fa-user text-purple-600 text-xs md:text-sm"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Siti Nurhaliza</span>
                            </div>
                        </td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500">siti@sekolah.sch.id</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500 hidden sm:table-cell">Guru</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Aktif
                            </span>
                        </td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell">2 minggu yang lalu</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-1 md:space-x-2">
                                <button onclick="viewUser(3, 'Siti Nurhaliza')" class="text-gray-600 hover:text-gray-900 p-1" title="Detail">
                                    <i class="fas fa-eye text-sm"></i>
                                </button>
                                <button onclick="editUser(3, 'Siti Nurhaliza')" class="text-blue-600 hover:text-blue-900 p-1" title="Edit">
                                    <i class="fas fa-edit text-sm"></i>
                                </button>
                                <button onclick="confirmDelete(3, 'Siti Nurhaliza')" class="text-red-600 hover:text-red-900 p-1" title="Hapus">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-900">#004</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-6 h-6 md:w-8 md:h-8 bg-orange-100 rounded-full flex items-center justify-center mr-2 md:mr-3">
                                    <i class="fas fa-user text-orange-600 text-xs md:text-sm"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Budi Santoso</span>
                            </div>
                        </td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500">budi@sekolah.sch.id</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500 hidden sm:table-cell">Staff</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Aktif
                            </span>
                        </td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell">3 minggu yang lalu</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-1 md:space-x-2">
                                <button onclick="viewUser(4, 'Budi Santoso')" class="text-gray-600 hover:text-gray-900 p-1" title="Detail">
                                    <i class="fas fa-eye text-sm"></i>
                                </button>
                                <button onclick="editUser(4, 'Budi Santoso')" class="text-blue-600 hover:text-blue-900 p-1" title="Edit">
                                    <i class="fas fa-edit text-sm"></i>
                                </button>
                                <button onclick="confirmDelete(4, 'Budi Santoso')" class="text-red-600 hover:text-red-900 p-1" title="Hapus">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-900">#005</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-6 h-6 md:w-8 md:h-8 bg-red-100 rounded-full flex items-center justify-center mr-2 md:mr-3">
                                    <i class="fas fa-user text-red-600 text-xs md:text-sm"></i>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Diana Putri</span>
                            </div>
                        </td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500">diana@sekolah.sch.id</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500 hidden sm:table-cell">Staff</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Non-Aktif
                            </span>
                        </td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell">1 bulan yang lalu</td>
                        <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-1 md:space-x-2">
                                <button onclick="viewUser(5, 'Diana Putri')" class="text-gray-600 hover:text-gray-900 p-1" title="Detail">
                                    <i class="fas fa-eye text-sm"></i>
                                </button>
                                <button onclick="editUser(5, 'Diana Putri')" class="text-blue-600 hover:text-blue-900 p-1" title="Edit">
                                    <i class="fas fa-edit text-sm"></i>
                                </button>
                                <button onclick="confirmDelete(5, 'Diana Putri')" class="text-red-600 hover:text-red-900 p-1" title="Hapus">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination Info -->
        <div class="px-4 md:px-6 py-3 md:py-4 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="text-sm text-gray-700 text-center sm:text-left">
                    Menampilkan <span class="font-medium">1</span> hingga <span class="font-medium">5</span> dari <span class="font-medium">5</span> hasil
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit User Modal -->
<div id="userModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4" id="modalTitle">Tambah Pengguna</h3>
            <form id="userForm" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" id="nama" name="nama" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select id="role" name="role" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Role</option>
                        <option value="admin">Administrator</option>
                        <option value="guru">Guru</option>
                        <option value="staff">Staff</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="status" name="status" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="1">Aktif</option>
                        <option value="0">Non-Aktif</option>
                    </select>
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeModal()" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showAddModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Pengguna';
    document.getElementById('userForm').reset();
    document.getElementById('userModal').classList.remove('hidden');
}

function editUser(id, name) {
    document.getElementById('modalTitle').textContent = 'Edit Pengguna';
    // Load user data based on id (static data for demo)
    const users = {
        1: { nama: 'Admin User', email: 'admin@sekolah.sch.id', role: 'admin', status: '1' },
        2: { nama: 'Ahmad Wijaya', email: 'ahmad@sekolah.sch.id', role: 'guru', status: '1' },
        3: { nama: 'Siti Nurhaliza', email: 'siti@sekolah.sch.id', role: 'guru', status: '1' },
        4: { nama: 'Budi Santoso', email: 'budi@sekolah.sch.id', role: 'staff', status: '1' },
        5: { nama: 'Diana Putri', email: 'diana@sekolah.sch.id', role: 'staff', status: '0' }
    };
    
    const user = users[id];
    if (user) {
        document.getElementById('nama').value = user.nama;
        document.getElementById('email').value = user.email;
        document.getElementById('password').value = '';
        document.getElementById('role').value = user.role;
        document.getElementById('status').value = user.status;
        document.getElementById('userModal').classList.remove('hidden');
    }
}

function viewUser(id, name) {
    Swal.fire({
        title: 'Detail Pengguna',
        html: `
            <div class="text-left">
                <p><strong>Nama:</strong> ${name}</p>
                <p><strong>Email:</strong> ${name.toLowerCase().replace(' ', '')}@sekolah.sch.id</p>
                <p><strong>Role:</strong> ${id === 1 ? 'Administrator' : id <= 3 ? 'Guru' : 'Staff'}</p>
                <p><strong>Status:</strong> ${id === 5 ? 'Non-Aktif' : 'Aktif'}</p>
            </div>
        `,
        icon: 'info',
        confirmButtonText: 'Tutup'
    });
}

function closeModal() {
    document.getElementById('userModal').classList.add('hidden');
}

function confirmDelete(id, name) {
    Swal.fire({
        title: 'Hapus Pengguna?',
        html: 'Apakah Anda yakin ingin menghapus pengguna <strong>"' + name + '"</strong>?<br><small>Tindakan ini tidak dapat dibatalkan.</small>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Terhapus!',
                text: 'Pengguna berhasil dihapus.',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            });
        }
    });
}

document.getElementById('userForm').addEventListener('submit', function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Berhasil!',
        text: 'Data pengguna berhasil disimpan.',
        icon: 'success',
        timer: 1500,
        showConfirmButton: false
    });
    closeModal();
});

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('userModal');
    if (event.target == modal) {
        closeModal();
    }
}
</script>
@endsection