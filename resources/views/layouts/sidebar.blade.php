<aside class="w-64 bg-gray-800 text-white flex flex-col h-screen hidden lg:block">
    <!-- TOP AREA -->
    <div class="flex flex-col flex-1 min-h-0">
        <!-- Logo Section -->
        <div class="p-4 pt-8">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-school text-white"></i>
                </div>
                <span class="text-xl font-bold">Sarana Sekolah</span>
            </div>
        </div>

        <!-- Navigation Area -->
        <nav class="flex-1 min-h-0 px-4 space-y-2 overflow-y-auto sidebar-scrollbar">    
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
               class="sidebar-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'sidebar-active' : 'hover:bg-gray-700' }}">
                <i class="fas fa-tachometer-alt w-5"></i>
                <span>Dashboard</span>
            </a>

            <!-- Aspirasi -->
            <a href="{{ route('aspirasi.index') }}"
               class="sidebar-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('aspirasi.*') ? 'sidebar-active' : 'hover:bg-gray-700' }}">
                <i class="fas fa-comment w-5"></i>
                <span>Aspirasi</span>
            </a>

            <!-- Laporan -->
            @if(auth()->guard('web')->check() && auth()->guard('web')->user()->name === 'admin')
            <a href="{{ route('laporan.index') }}"
               class="sidebar-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('laporan.*') ? 'sidebar-active' : 'hover:bg-gray-700' }}">
                <i class="fas fa-file-alt w-5"></i>
                <span>Laporan</span>
            </a>
            @endif

            <!-- Kategori -->
            @if(auth()->guard('web')->check() && auth()->guard('web')->user()->name === 'admin')
            <a href="{{ route('kategori.index') }}"
               class="sidebar-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('kategori.*') ? 'sidebar-active' : 'hover:bg-gray-700' }}">
                <i class="fas fa-tags w-5"></i>
                <span>Kategori</span>
            </a>
            @endif

            <!-- Master Data -->
            @if(auth()->guard('web')->check() && auth()->guard('web')->user()->name === 'admin')
            <div class="space-y-1">
                <button onclick="toggleSubmenu('sarana-submenu')"
                    class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition-colors duration-200 text-left">
                    <i class="fas fa-building w-5"></i>
                    <span>Master Data</span>
                    <i id="sarana-chevron" class="fas fa-chevron-down ml-auto text-xs transition-transform duration-200"></i>
                </button>

                <div id="sarana-submenu"
                    class="ml-8 space-y-1 max-h-40 overflow-y-auto sidebar-scrollbar-sub hidden">
                    <a href="{{ route('jurusan.index') }}"
                       class="sidebar-item block px-4 py-2 text-sm rounded hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('jurusan.*') ? 'sidebar-active' : '' }}">
                        Jurusan Data
                    </a>
                </div>
            </div>
            @endif

            <!-- Manajemen User -->
            @if(auth()->guard('web')->check() && auth()->guard('web')->user()->name === 'admin')
            <div class="space-y-1">
                <button onclick="toggleSubmenu('manajement-submenu')"
                    class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition-colors duration-200 text-left">
                    <i class="fas fa-users w-5"></i>
                    <span>Manajemen User</span>
                    <i id="manajement-chevron"
                       class="fas fa-chevron-down ml-auto text-xs transition-transform duration-200"></i>
                </button>

                <div id="manajement-submenu"
                     class="ml-8 space-y-1 max-h-40 overflow-y-auto sidebar-scrollbar-sub hidden">

                    <a href="{{ route('siswa.index') }}"
                       class="sidebar-item block px-4 py-2 text-sm rounded hover:bg-gray-700 transition-colors duration-200">
                        Siswa
                    </a>

                    <a href="{{ route('pengguna.index') }}"
                       class="sidebar-item block px-4 py-2 text-sm rounded hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('pengguna.*') ? 'sidebar-active' : '' }}">
                        Pengguna
                    </a>

                </div>
            </div>
            @endif

            <div class="h-24"></div>

        </nav>
    </div>


    <!-- USER AREA (BOTTOM) -->
    <div class="p-8 border-t border-gray-700">
        <div class="flex items-center justify-between">

            <div class="flex items-center space-x-3 flex-1 min-w-0">
                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>

                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium truncate">
                        @if(auth()->guard('web')->check())
                            {{ auth()->guard('web')->user()->name }}
                        @else
                            {{ auth()->guard('siswas')->user()->nama }}
                        @endif
                    </p>

                    <p class="text-xs text-gray-400 truncate">
                        @if(auth()->guard('web')->check())
                            Administrator
                        @else
                            {{ auth()->guard('siswas')->user()->nisn }}
                        @endif
                    </p>
                </div>
            </div>

            <!-- Logout -->
            <form action="{{ route('logout') }}" method="POST" class="ml-2">
                @csrf
                <button type="submit"
                    class="p-2 text-gray-400 hover:text-white hover:bg-red-600 transition-colors duration-200 rounded-lg"
                    title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>

        </div>
    </div>

</aside>