<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pengaduan Suara Sarana Sekolah')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('layouts.sidebar')
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            @include('layouts.header')
            
            <!-- Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                @yield('content')
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
