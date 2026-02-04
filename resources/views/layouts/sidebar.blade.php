<aside class="w-64 bg-gray-800 text-white flex flex-col h-screen">
    <div class="p-4 flex-shrink-0">
        <div class="flex items-center space-x-3 mb-8">
            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-school text-white"></i>
            </div>
            <span class="text-xl font-bold">Sarana Sekolah</span>
        </div>
    </div>
    
    <nav class="flex-1 px-4 overflow-y-auto space-y-2 scrollbar-hide">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" class="sidebar-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'sidebar-active' : 'hover:bg-gray-700' }}">
            <i class="fas fa-tachometer-alt w-5"></i>
            <span>Dashboard</span>
        </a>
        
        <!-- Kategori -->
        <a href="{{ route('kategori.index') }}" class="sidebar-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('kategori.*') ? 'sidebar-active' : 'hover:bg-gray-700' }}">
            <i class="fas fa-tags w-5"></i>
            <span>Kategori</span>
        </a>
        
        <!-- Master Data -->
        <div class="space-y-1">
            <button onclick="toggleSubmenu('sarana-submenu')" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition-colors duration-200 text-left">
                <i class="fas fa-building w-5"></i>
                <span>Master Data</span>
                <i id="sarana-chevron" class="fas fa-chevron-down ml-auto text-xs transition-transform duration-200"></i>
            </button>
            <div id="sarana-submenu" class="ml-8 space-y-1 hidden">
                <a href="{{ route('jurusan.index') }}" class="sidebar-item block px-4 py-2 text-sm rounded hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('jurusan.*') ? 'sidebar-active' : '' }}">
                    Jurusan Data
                </a>
            </div>
        </div>
        
        <!-- Siswa -->
        <a href="{{ route('siswa.index') }}" class="sidebar-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('laporan.*') ? 'sidebar-active' : 'hover:bg-gray-700' }}">
            <i class="fas fa-chart-bar w-5"></i>
            <span>Siswa</span>
        </a>
        
        <!-- Pengguna -->
        <a href="{{ route('pengguna.index') }}" class="sidebar-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('pengguna.*') ? 'sidebar-active' : 'hover:bg-gray-700' }}">
            <i class="fas fa-users w-5"></i>
            <span>Pengguna</span>
        </a>
        
        <!-- Pengaturan -->
        <div class="space-y-1">
            <button onclick="toggleSubmenu('pengaturan-submenu')" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition-colors duration-200 text-left">
                <i class="fas fa-cog w-5"></i>
                <span>Pengaturan</span>
                <i id="pengaturan-chevron" class="fas fa-chevron-down ml-auto text-xs transition-transform duration-200"></i>
            </button>
            <div id="pengaturan-submenu" class="ml-8 space-y-1 hidden">
                <a href="{{ route('pengaturan.profil') }}" class="sidebar-item block px-4 py-2 text-sm rounded hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('pengaturan.profil') ? 'sidebar-active' : '' }}">
                    Profil Sekolah
                </a>
                <a href="{{ route('pengaturan.sistem') }}" class="sidebar-item block px-4 py-2 text-sm rounded hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('pengaturan.sistem') ? 'sidebar-active' : '' }}">
                    Pengaturan Sistem
                </a>
            </div>
        </div>
        
        <!-- Spacer untuk memastikan ada ruang di bawah -->
        <div class="h-20"></div>
    </nav>
    
    <!-- User Section - Fixed di bottom -->
    <div class="p-4 border-t border-gray-700 flex-shrink-0">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                <i class="fas fa-user text-white text-sm"></i>
            </div>
            <div class="flex-1">
                <p class="text-sm font-medium">Admin User</p>
                <p class="text-xs text-gray-400">admin@sekolah.sch.id</p>
            </div>
            <button class="text-gray-400 hover:text-white">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </div>
    </div>
</aside>
