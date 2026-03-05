<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="px-6 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <button id="sidebarToggle" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <h1 class="text-sm md:text-md lg:text-lg font-bold text-gray-800">
                    <i class="fas fa-school text-blue-600 mr-2"></i>
                    Pengaduan Suara Sarana Sekolah
                </h1>
            </div>
            
            <div class="flex items-center space-x-4">
                <!-- Search Bar -->
                <div class="relative">
                    <input type="text" 
                           placeholder="Cari pengaduan..." 
                           class="w-48 md:w-64 px-4 py-2 pl-10 pr-4 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                </div>
                
                <!-- Notifications -->
                <button class="relative text-gray-500 hover:text-gray-700 focus:outline-none">
                    <i class="fas fa-bell text-xl"></i>
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                </button>
                
                <!-- User Profile -->
                <div class="flex items-center space-x-3 text-xs md:text-sm">
                    <div class="text-right">
                        <p class="text-xs font-medium text-gray-700">Admin User</p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                    <div class="h-10 w-10 bg-blue-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
