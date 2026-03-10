<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pengaduan Suara Sarana Sekolah')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://unpkg.com/sweetalert2@11"></script>
    <style>
        .sidebar-active {
            background-color: #3b82f6 !important;
            color: white !important;
        }
        .sidebar-item:hover {
            background-color: #1e40af;
            color: white;
        }
        
        /* Hide scrollbar for Chrome, Safari and Opera */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        
        /* Hide scrollbar for IE, Edge and Firefox */
        .scrollbar-hide {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        
        /* Custom scrollbar for content */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        
        /* Custom scrollbar for sidebar */
        .sidebar-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        
        .sidebar-scrollbar::-webkit-scrollbar-track {
            background: #374151;
        }
        
        .sidebar-scrollbar::-webkit-scrollbar-thumb {
            background: #6b7280;
            border-radius: 2px;
        }
        
        .sidebar-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
        
        /* Custom scrollbar for submenu */
        .sidebar-scrollbar-sub::-webkit-scrollbar {
            width: 3px;
        }
        
        .sidebar-scrollbar-sub::-webkit-scrollbar-track {
            background: #4b5563;
        }
        
        .sidebar-scrollbar-sub::-webkit-scrollbar-thumb {
            background: #9ca3af;
            border-radius: 2px;
        }
        
        .sidebar-scrollbar-sub::-webkit-scrollbar-thumb:hover {
            background: #d1d5db;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white flex flex-col h-screen hidden lg:block flex-shrink-0">
            @include('layouts.sidebar')
        </aside>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200 flex-shrink-0">
                @include('layouts.header')
            </header>
            
            <!-- Content Area with Scroll -->
            <main class="flex-1 p-6 overflow-y-auto custom-scrollbar">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    
    <script>
        // Active menu functionality
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const menuItems = document.querySelectorAll('.sidebar-item');
            
            menuItems.forEach(item => {
                const href = item.getAttribute('href');
                if (href === currentPath || (href !== '/' && currentPath.startsWith(href))) {
                    item.classList.add('sidebar-active');
                }
            });
            
            // Auto-expand submenu if any child is active
            const activeSubmenuItems = document.querySelectorAll('.sidebar-item.sidebar-active');
            activeSubmenuItems.forEach(item => {
                const submenu = item.closest('[id$="-submenu"]');
                if (submenu) {
                    submenu.classList.remove('hidden');
                    const chevron = document.getElementById(submenu.id.replace('-submenu', '-chevron'));
                    if (chevron) {
                        chevron.classList.add('rotate-180');
                    }
                }
            });
        });
        
        function toggleSubmenu(submenuId) {
            const submenu = document.getElementById(submenuId);
            const chevron = document.getElementById(submenuId.replace('-submenu', '-chevron'));
            
            if (submenu.classList.contains('hidden')) {
                submenu.classList.remove('hidden');
                chevron.classList.add('rotate-180');
            } else {
                submenu.classList.add('hidden');
                chevron.classList.remove('rotate-180');
            }
        }
    </script>
</body>
</html>
