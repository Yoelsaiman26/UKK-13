<header class="bg-white shadow-sm border-b border-gray-200" x-data="{ sidebarOpen: false }">

    <div class="px-6 py-4">
        <div class="flex items-center justify-between">

            <!-- Mobile Menu -->
            <div class="flex lg:hidden items-center space-x-4">
                <button 
                    @click="sidebarOpen = true"
                    class="text-gray-600 hover:text-gray-900 focus:outline-none">

                    <i class="fas fa-bars text-xl"></i>
                </button>

                <h1 class="text-sm md:text-md lg:text-lg font-bold text-gray-800">
                    <i class="fas fa-school text-blue-600 mr-2"></i>
                    Pengaduan Sarana Sekolah
                </h1>
            </div>

            <div class="hidden lg:block">
                
            </div>

            <!-- Right Menu -->
            <div class="flex items-center space-x-4">

                <!-- Search -->
                <div class="relative hidden md:block">
                    <input type="text" 
                        placeholder="Cari pengaduan..." 
                        class="w-48 md:w-64 px-4 py-2 pl-10 pr-4 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                </div>

                <!-- Notification -->
                <button class="relative text-gray-500 hover:text-gray-700 focus:outline-none">
                    <i class="fas fa-bell text-xl"></i>

                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                        3
                    </span>
                </button>

                <!-- User Profile -->
                <a href="{{ route('profile.index') }}" class="flex items-center space-x-3 text-xs md:text-sm hover:bg-gray-50 rounded-lg px-3 py-2 transition duration-150 cursor-pointer">
                    <div class="text-right">

                        <p class="font-medium text-gray-700">
                            @if(Auth::guard('web')->check())
                                {{ Auth::guard('web')->user()->name }}
                            @else
                                {{ Auth::guard('siswas')->user()->nama ?? '' }}
                            @endif
                        </p>

                        <p class="text-gray-500 text-xs">
                            @if(Auth::guard('web')->check())
                                Administrator
                            @else
                                {{ Auth::guard('siswas')->user()->nisn ?? '' }}
                            @endif
                        </p>

                    </div>

                    <div class="h-10 w-10 bg-blue-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                </a>

            </div>

        </div>
    </div>

    <!-- Overlay -->
    <div 
        x-show="sidebarOpen"
        x-cloak
        x-transition.opacity
        @click="sidebarOpen = false"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 lg:hidden">
    </div>

    <!-- Mobile Sidebar -->
    <div 
        x-show="sidebarOpen"
        x-cloak
        x-transition:enter="transition transform ease-out duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition transform ease-in duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed top-0 left-0 w-64 h-full bg-gray-800 text-white shadow-xl z-50 lg:hidden overflow-y-auto"
    >

        <!-- Header -->
        <div class="p-4 flex justify-between items-center border-b border-gray-700">
            <div class="flex items-center space-x-2">
                <i class="fas fa-school text-blue-400"></i>
                <span class="font-bold">Menu</span>
            </div>

            <button @click="sidebarOpen = false">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="px-4 py-4 space-y-2">

            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" 
            class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                <i class="fas fa-tachometer-alt w-5"></i>
                <span>Dashboard</span>
            </a>

            <!-- Aspirasi -->
            <a href="{{ route('aspirasi.index') }}" 
            class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('aspirasi.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                <i class="fas fa-comment w-5"></i>
                <span>Aspirasi</span>
            </a>

            <!-- Kategori -->
            @if(auth()->guard('web')->check() && auth()->guard('web')->user()->name === 'admin')
            <a href="{{ route('kategori.index') }}" 
            class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('kategori.*') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                <i class="fas fa-tags w-5"></i>
                <span>Kategori</span>
            </a>
            @endif


            <!-- Master Data -->
            @if(auth()->guard('web')->check() && auth()->guard('web')->user()->name === 'admin')
            <div>
                <p class="px-4 pt-4 text-xs text-gray-400 uppercase">Master Data</p>

                <a href="{{ route('jurusan.index') }}" 
                class="block px-6 py-2 text-sm hover:bg-gray-700 rounded">
                    Jurusan Data
                </a>
            </div>
            @endif


            <!-- Manajemen User -->
            @if(auth()->guard('web')->check() && auth()->guard('web')->user()->name === 'admin')
            <div>
                <p class="px-4 pt-4 text-xs text-gray-400 uppercase">Manajemen User</p>

                <a href="{{ route('siswa.index') }}" 
                class="block px-6 py-2 text-sm hover:bg-gray-700 rounded">
                    Siswa
                </a>

                <a href="{{ route('pengguna.index') }}" 
                class="block px-6 py-2 text-sm hover:bg-gray-700 rounded">
                    Pengguna
                </a>
            </div>
            @endif


            <!-- Pengaturan -->
            <div>
                <p class="px-4 pt-4 text-xs text-gray-400 uppercase">Pengaturan</p>

                <a href="{{ route('pengaturan.profil') }}" 
                class="block px-6 py-2 text-sm hover:bg-gray-700 rounded">
                    Profil Sekolah
                </a>

                <a href="{{ route('pengaturan.sistem') }}" 
                class="block px-6 py-2 text-sm hover:bg-gray-700 rounded">
                    Pengaturan Sistem
                </a>
            </div>

        </nav>

    </div>

</header>