@extends('layouts.app')

@section('title', 'Manajemen Aspirasi - Suara Sarana Sekolah')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-4 md:p-6 text-white">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl md:text-2xl font-bold mb-2">Manajemen Aspirasi</h2>
                <p class="text-blue-100 text-sm md:text-base">Kelola semua aspirasi dan usulan dari siswa</p>
            </div>
            
            @if(auth()->guard('siswas')->check())
            <button onclick="openCreateModal()" class="w-full sm:w-auto bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition-colors duration-200 cursor-pointer">
                <i class="fas fa-plus mr-2"></i>Tambah Aspirasi
            </button>
            @endif
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-lg shadow p-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <input type="text" id="searchInput" placeholder="Cari aspirasi..."  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select id="kategoriFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select id="statusFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="proses">Diproses</option>
                    <option value="selesai">Selesai</option>
                    <option value="ditolak">Ditolak</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">&nbsp;</label>
                <button onclick="filterData()" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-4 py-3 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-base md:text-lg font-semibold text-gray-800">Daftar Aspirasi</h3>
            <span class="text-sm text-gray-500">Menampilkan <span id="totalCount">0</span> data</span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelapor</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody id="aspirasiTableBody" class="bg-white divide-y divide-gray-200">
                    @forelse ($aspirasis as $index => $aspirasi)
                    <tr>
                        <td class="px-4 py-3 text-sm text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900">
                            <div class="font-medium">{{ $aspirasi->judul }}</div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900">
                            {{ $aspirasi->siswa->nama ?? 'Tidak ada pelapor' }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                {{ $aspirasi->kategori->nama ?? 'Tidak ada kategori' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            @switch($aspirasi->status)
                                @case('pending')
                                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i>Pending
                                    </span>
                                    @break
                                @case('diproses')
                                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                        <i class="fas fa-spinner mr-1"></i>Diproses
                                    </span>
                                    @break
                                @case('selesai')
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>Selesai
                                    </span>
                                    @break
                                @default
                                    <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">
                                        <i class="fas fa-question mr-1"></i>Tidak Diketahui
                                    </span>
                                    @break
                            @endswitch
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900">
                            {{ $aspirasi->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3 text-sm text-center">
                            <a href="{{ route('aspirasi.show', $aspirasi->id) }}" class="text-gray-600 hover:text-gray-900 mr-2" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if(auth()->guard('siswas')->check() && $aspirasi->balasan !== null ?? $aspirasi->status !== 'pending')
                                <button id="lihatBalasan{{ $aspirasi->id }}" class="text-green-600 hover:text-green-800 mr-2" title="Lihat Balasan">
                                    <i class="fa-solid fa-inbox"></i></i>
                                </button>
                            @endif
                            @if(auth()->guard('web')->check())
                                <button id="replyButton{{ $aspirasi->id }}" class="text-blue-600 hover:text-blue-800 mr-2">
                                    <i class="fa-solid fa-reply"></i>
                                </button>
                            @endif
                            @if(auth()->guard('siswas')->check())
                                <button onclick="editAspirasi({{ $aspirasi->id }})" class="text-blue-600 hover:text-blue-800 mr-2">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteAspirasi({{ $aspirasi->id }})" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-2"></i>
                            <div>Belum ada data aspirasi</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-4 py-3 border-t border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="text-sm text-gray-700">
                Menampilkan <span id="showingFrom">0</span> - <span id="showingTo">0</span> dari <span id="totalData">0</span> data
            </div>
            <div class="flex gap-2">
                <button onclick="previousPage()" class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 disabled:opacity-50" id="prevBtn">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <span class="px-3 py-1 bg-blue-600 text-white rounded" id="currentPage">1</span>
                <button onclick="nextPage()" class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 disabled:opacity-50" id="nextBtn">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Create/Edit Modal -->
<div id="aspirasiModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800" id="modalTitle">Tambah Aspirasi</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="aspirasiForm" class="px-4 py-6 space-y-6">
                @csrf
                <input type="hidden" id="aspirasiId" name="id">
                
                <!-- Informasi Utama -->
                <div class="space-y-4">
                    <h4 class="text-sm font-medium text-gray-900 border-b pb-2">Informasi Utama</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                         <div>
                            <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">
                                Judul <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="judul" 
                                   name="judul" 
                                   required
                                   placeholder="Masukkan Judul"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <p class="mt-1 text-xs text-gray-500">Judul Aspirasi</p>
                        </div>
                        
                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <select id="kategori" 
                                    name="kategori_id" 
                                    required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-xs text-gray-500">Kategori aspirasi</p>
                        </div>
                    </div>
                </div>
                
                <!-- Detail Aspirasi -->
                <div class="space-y-4">
                    <h4 class="text-sm font-medium text-gray-900 border-b pb-2">Detail Aspirasi</h4>
                    
                    <div>
                        <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">
                            Keterangan <span class="text-red-500">*</span>
                        </label>
                        <textarea id="keterangan" 
                                  name="keterangan" 
                                  rows="4"
                                  required
                                  placeholder="Jelaskan detail aspirasi Anda..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        <p class="mt-1 text-xs text-gray-500">Jelaskan aspirasi secara detail</p>
                    </div>
                    
                    <div>
                        <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">
                            Lokasi
                        </label>
                        <input type="text" 
                               id="lokasi" 
                               name="lokasi" 
                               placeholder="Contoh: Ruang Kelas XI IPA 1"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="mt-1 text-xs text-gray-500">Lokasi terkait aspirasi (opsional)</p>
                    </div>
                </div>
                
                <!-- Informasi Pelapor -->
                <div class="space-y-4">
                    <h4 class="text-sm font-medium text-gray-900 border-b pb-2">Informasi Pelapor</h4>
                    
                    <div>
                        <label for="siswa_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Siswa <span class="text-red-500">*</span>
                        </label>
                        
                        @if(auth()->guard('siswas')->check())
                            <!-- Jika siswa login, tampilkan readonly field -->
                            <input type="text" 
                                id="siswa_id" 
                                name="siswa_id" 
                                value="{{ $siswaLogin->nama }} ({{ $siswaLogin->nisn }})"
                                readonly
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <input type="hidden" name="siswa_id" value="{{ $siswaLogin->id }}">
                        @else
                            <!-- Jika admin login, tampilkan dropdown -->
                            <select name="siswa_id" id="siswa_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Siswa</option>
                                @foreach($siswas as $siswa)
                                    <option value="{{ $siswa->id }}">{{ $siswa->nama }} ({{ $siswa->nisn }})</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-6 border-t border-gray-200">
                    <button type="button" onclick="closeModal()" class="w-full sm:w-auto px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors duration-200 text-center font-medium">
                        <i class="fas fa-times mr-2"></i>Batal
                    </button>
                    <button type="submit" class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium">
                        <i class="fas fa-save mr-2"></i>Simpan Aspirasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-3xl w-full max-h-[90vh] overflow-y-auto">
            <div class="px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">Detail Aspirasi</h3>
                <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div id="detailContent" class="px-4 py-6">
                <!-- Detail akan dimuat dengan JavaScript -->
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-md w-full transform transition-all duration-300 scale-95 opacity-0" id="deleteModalContent">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">Konfirmasi Hapus</h3>
                        <p class="text-sm text-gray-500">Tindakan ini tidak dapat dibatalkan</p>
                    </div>
                </div>
            </div>
            
            <!-- Modal Body -->
            <div class="px-6 py-4">
                <p class="text-gray-700">Apakah Anda yakin ingin menghapus aspirasi ini? Semua data terkait akan dihapus secara permanen.</p>
            </div>
            
            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-gray-50 rounded-b-lg flex flex-col sm:flex-row sm:justify-end gap-3">
                <button onclick="closeDeleteModal()" class="w-full sm:w-auto px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-all duration-200 font-medium">
                    <i class="fas fa-times mr-2"></i>Batal
                </button>
                <button onclick="confirmDelete()" class="w-full sm:w-auto px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-200 font-medium">
                    <i class="fas fa-trash mr-2"></i>Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Reply Modal -->
<div id="replyModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto transform transition-all duration-300 scale-95 opacity-0" id="replyModalContent">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-blue-700 rounded-t-lg">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-reply text-white"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-semibold text-white">Balas Aspirasi</h3>
                            <p class="text-blue-100 text-sm">Beri tanggapan pada aspirasi siswa</p>
                        </div>
                    </div>
                    <button onclick="closeReplyModal()" class="text-white/80 hover:text-white transition-colors duration-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <!-- Modal Body -->
            <form id="replyForm" class="px-6 py-6 space-y-6">
                @csrf
                <input type="hidden" id="replyAspirasiId" name="aspirasi_id">
                
                <!-- Aspirasi Info -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-gray-700 mb-2">Detail Aspirasi</h4>
                    <div class="space-y-2">
                        <div class="flex items-start">
                            <span class="text-sm font-medium text-gray-600 w-20">Judul:</span>
                            <span id="replyJudul" class="text-sm text-gray-900 flex-1"></span>
                        </div>
                        <div class="flex items-start">
                            <span class="text-sm font-medium text-gray-600 w-20">Pelapor:</span>
                            <span id="replyPelapor" class="text-sm text-gray-900 flex-1"></span>
                        </div>
                        <div class="flex items-start">
                            <span class="text-sm font-medium text-gray-600 w-20">Kategori:</span>
                            <span id="replyKategori" class="text-sm text-gray-900 flex-1"></span>
                        </div>
                    </div>
                </div>
                
                <!-- Balasan Field -->
                <div>
                    <label for="balasan" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-comment-dots mr-2"></i>Balasan <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="balasan" 
                        name="balasan" 
                        rows="5"
                        required
                        placeholder="Tulis balasan atau tanggapan Anda..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                    ></textarea>
                    <p class="mt-1 text-xs text-gray-500">Berikan tanggapan yang jelas dan membantu</p>
                </div>
                
                <!-- Status Field -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-flag mr-2"></i>Status <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="status" 
                        name="status" 
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="">Pilih Status</option>
                        <option value="pending">Pending</option>
                        <option value="diproses">Diproses</option>
                        <option value="selesai">Selesai</option>
                    </select>
                    <p class="mt-1 text-xs text-gray-500">Perbarui status aspirasi</p>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-6 border-t border-gray-200">
                    <button type="button" onclick="closeReplyModal()" class="w-full sm:w-auto px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-all duration-200 font-medium">
                        <i class="fas fa-times mr-2"></i>Batal
                    </button>
                    <button type="submit" class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 font-medium">
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Balasan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Lihat Balasan Modal -->
<div id="lihatBalasanModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto transform transition-all duration-300 scale-95 opacity-0" id="lihatBalasanModalContent">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-green-600 to-green-700 rounded-t-lg">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-comments text-white"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-semibold text-white">Balasan Admin</h3>
                            <p class="text-green-100 text-sm">Tanggapan dari admin untuk aspirasi Anda</p>
                        </div>
                    </div>
                    <button onclick="closeLihatBalasanModal()" class="text-white/80 hover:text-white transition-colors duration-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <!-- Modal Body -->
            <div class="px-6 py-6 space-y-6">
                <!-- Aspirasi Info -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-gray-700 mb-2">Detail Aspirasi Anda</h4>
                    <div class="space-y-2">
                        <div class="flex items-start">
                            <span class="text-sm font-medium text-gray-600 w-20">Judul:</span>
                            <span id="lihatJudul" class="text-sm text-gray-900 flex-1"></span>
                        </div>
                        <div class="flex items-start">
                            <span class="text-sm font-medium text-gray-600 w-20">Kategori:</span>
                            <span id="lihatKategori" class="text-sm text-gray-900 flex-1"></span>
                        </div>
                        <div class="flex items-start">
                            <span class="text-sm font-medium text-gray-600 w-20">Tanggal:</span>
                            <span id="lihatTanggal" class="text-sm text-gray-900 flex-1"></span>
                        </div>
                    </div>
                </div>
                
                <!-- Status Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-blue-800 mb-2">
                        <i class="fas fa-flag mr-2"></i>Status Saat Ini
                    </h4>
                    <div id="lihatStatus" class="text-sm font-medium text-blue-900"></div>
                </div>
                
                <!-- Balasan Admin -->
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-green-800 mb-3">
                        <i class="fas fa-reply mr-2"></i>Balasan dari Admin
                    </h4>
                    <div id="lihatBalasan" class="text-sm text-gray-800 whitespace-pre-wrap bg-white rounded-lg p-3 border border-green-300"></div>
                </div>
                
                <!-- Info Tambahan -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-yellow-600 mt-0.5 mr-3"></i>
                        <div class="text-sm text-yellow-800">
                            <p class="font-medium mb-1">Informasi</p>
                            <p>Terima kasih telah mengajukan aspirasi. Admin telah memberikan tanggapan untuk aspirasi Anda. Silakan perhatikan status dan balasan yang diberikan.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Action Button -->
                <div class="flex justify-end pt-4 border-t border-gray-200">
                    <button onclick="closeLihatBalasanModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-all duration-200 font-medium">
                        <i class="fas fa-check mr-2"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Debug function
function debugModal() {
    console.log('Modal element:', document.getElementById('aspirasiModal'));
    console.log('Button clicked!');
}

// Modal functions
function openCreateModal() {
    console.log('openCreateModal called');
    const modal = document.getElementById('aspirasiModal');
    if (modal) {
        document.getElementById('modalTitle').textContent = 'Tambah Aspirasi';
        document.getElementById('aspirasiForm').reset();
        document.getElementById('aspirasiId').value = '';
        modal.classList.remove('hidden');
        console.log('Modal opened');
    } else {
        console.error('Modal not found');
    }
}

function closeModal() {
    console.log('closeModal called');
    const modal = document.getElementById('aspirasiModal');
    if (modal) {
        modal.classList.add('hidden');
        console.log('Modal closed');
    }
}

function closeDetailModal() {
    document.getElementById('detailModal').classList.add('hidden');
}

// Delete modal functions
let deleteId = null;

function deleteAspirasi(id) {
    deleteId = id;
    const modal = document.getElementById('deleteModal');
    const modalContent = document.getElementById('deleteModalContent');
    
    modal.classList.remove('hidden');
    
    // Add animation
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    const modalContent = document.getElementById('deleteModalContent');
    
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        deleteId = null;
    }, 300);
}

function confirmDelete() {
    if (deleteId) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/aspirasi/${deleteId}`;
        form.innerHTML = `
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        `;
        document.body.appendChild(form);
        form.submit();
    }
}

// Reply modal functions
function openReplyModal(id) {
    // Fetch aspirasi data using the edit endpoint (which returns JSON)
    fetch(`/aspirasi/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            // Populate modal with aspirasi data
            document.getElementById('replyAspirasiId').value = data.id;
            document.getElementById('replyJudul').textContent = data.judul;
            document.getElementById('replyPelapor').textContent = data.siswa ? data.siswa.nama : 'Tidak ada pelapor';
            document.getElementById('replyKategori').textContent = data.kategori ? data.kategori.nama : 'Tidak ada kategori';
            
            // Set current status if exists
            if (data.status) {
                document.getElementById('status').value = data.status;
            }
            
            // Set current balasan if exists
            if (data.balasan) {
                document.getElementById('balasan').value = data.balasan;
            }
            
            // Show modal with animation
            const modal = document.getElementById('replyModal');
            const modalContent = document.getElementById('replyModalContent');
            
            modal.classList.remove('hidden');
            
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal mengambil data aspirasi');
        });
}

function closeReplyModal() {
    const modal = document.getElementById('replyModal');
    const modalContent = document.getElementById('replyModalContent');
    
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        // Reset form
        document.getElementById('replyForm').reset();
    }, 300);
}

// Reply form submission
document.getElementById('replyForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const aspirasiId = document.getElementById('replyAspirasiId').value;
    
    // Debug: Log form data
    console.log('Submitting reply form...');
    console.log('Aspirasi ID:', aspirasiId);
    console.log('Form data:');
    for (let [key, value] of formData.entries()) {
        console.log(key + ': ' + value);
    }
    
    formData.append('_token', '{{ csrf_token() }}');
    
    fetch(`/aspirasi/umpan-balik/${aspirasiId}`, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (response.ok) {
            window.location.href = '/aspirasi';
        } else {
            return response.text().then(text => {
                console.log('Error response:', text);
                alert('Gagal mengirim balasan');
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengirim balasan');
    });
});

// Form submission
document.getElementById('aspirasiForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const aspirasiId = document.getElementById('aspirasiId').value;
    
    if (aspirasiId) {
        // Update existing aspirasi
        formData.append('_method', 'PUT');
        formData.append('_token', '{{ csrf_token() }}');
        
        fetch(`/aspirasi/${aspirasiId}`, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                window.location.href = '/aspirasi';
            } else {
                alert('Gagal memperbarui aspirasi');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memperbarui aspirasi');
        });
    } else {
        // Create new aspirasi
        this.action = '{{ route("aspirasi.store") }}';
        this.method = 'POST';
        this.submit();
    }
});

// Edit function
function editAspirasi(id) {
    // Fetch aspirasi data via AJAX
    fetch(`/aspirasi/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            // Populate form with data
            document.getElementById('modalTitle').textContent = 'Edit Aspirasi';
            document.getElementById('aspirasiId').value = data.id;
            document.getElementById('judul').value = data.judul;
            document.getElementById('kategori').value = data.kategori_id;
            document.getElementById('keterangan').value = data.keterangan || '';
            document.getElementById('lokasi').value = data.lokasi || '';
            document.getElementById('siswa_id').value = data.siswa_id;
            
            // Open modal
            document.getElementById('aspirasiModal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal mengambil data aspirasi');
        });
}

// Lihat Balasan Modal Functions
function openLihatBalasanModal(id) {
    // Fetch aspirasi data using the edit endpoint (which returns JSON)
    fetch(`/aspirasi/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            // Populate modal with aspirasi data
            document.getElementById('lihatJudul').textContent = data.judul;
            document.getElementById('lihatKategori').textContent = data.kategori ? data.kategori.nama : 'Tidak ada kategori';
            document.getElementById('lihatTanggal').textContent = new Date(data.created_at).toLocaleDateString('id-ID');
            document.getElementById('lihatBalasan').textContent = data.balasan || 'Tidak ada balasan';
            
            // Set status dengan icon dan warna
            let statusHtml = '';
            switch(data.status) {
                case 'pending':
                    statusHtml = '<span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800"><i class="fas fa-clock mr-1"></i>Pending</span>';
                    break;
                case 'diproses':
                    statusHtml = '<span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800"><i class="fas fa-spinner mr-1"></i>Diproses</span>';
                    break;
                case 'selesai':
                    statusHtml = '<span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800"><i class="fas fa-check-circle mr-1"></i>Selesai</span>';
                    break;
                default:
                    statusHtml = '<span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800"><i class="fas fa-question mr-1"></i>Tidak Diketahui</span>';
                    break;
            }
            document.getElementById('lihatStatus').innerHTML = statusHtml;
            
            // Show modal with animation
            const modal = document.getElementById('lihatBalasanModal');
            const modalContent = document.getElementById('lihatBalasanModalContent');
            
            modal.classList.remove('hidden');
            
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal mengambil data aspirasi');
        });
}

function closeLihatBalasanModal() {
    const modal = document.getElementById('lihatBalasanModal');
    const modalContent = document.getElementById('lihatBalasanModalContent');
    
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

// Update total count
document.addEventListener('DOMContentLoaded', function() {
    const totalCount = document.querySelectorAll('#aspirasiTableBody tr').length;
    document.getElementById('totalCount').textContent = totalCount;
    console.log('Page loaded, total count:', totalCount);
    
    // Add click event listeners to reply buttons
    @foreach($aspirasis as $aspirasi)
        const replyButton{{ $aspirasi->id }} = document.getElementById('replyButton{{ $aspirasi->id }}');
        if (replyButton{{ $aspirasi->id }}) {
            replyButton{{ $aspirasi->id }}.addEventListener('click', function() {
                openReplyModal({{ $aspirasi->id }});
            });
        }
        
        // Add event listeners for lihat balasan buttons
        const lihatBalasanButton{{ $aspirasi->id }} = document.getElementById('lihatBalasan{{ $aspirasi->id }}');
        if (lihatBalasanButton{{ $aspirasi->id }}) {
            lihatBalasanButton{{ $aspirasi->id }}.addEventListener('click', function() {
                openLihatBalasanModal({{ $aspirasi->id }});
            });
        }
    @endforeach
});
</script>
@endsection