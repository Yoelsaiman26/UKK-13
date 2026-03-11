<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sarana Sekolah</title>
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
        
        .login-bg {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 25%, #3b82f6 50%, #2563eb 75%, #1d4ed8 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .glass-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }
        
        .floating-shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border-radius: 50%;
            animation: float-shape 20s infinite ease-in-out;
        }
        
        @keyframes float-shape {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(30px, -30px) rotate(90deg); }
            50% { transform: translate(-20px, 20px) rotate(180deg); }
            75% { transform: translate(-30px, -20px) rotate(270deg); }
        }
    </style>
</head>
<body class="login-bg min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Floating Shapes -->
    <div class="floating-shapes absolute w-full h-full overflow-hidden z-0">
        <div class="floating-shape w-20 h-20 top-20 left-10" style="animation-delay: 0s;"></div>
        <div class="floating-shape w-32 h-32 top-60 right-10" style="animation-delay: 3s;"></div>
        <div class="floating-shape w-16 h-16 bottom-20 left-20" style="animation-delay: 6s;"></div>
    </div>

    <!-- Login Container -->
    <div class="relative z-10 w-full h-full flex items-center justify-center p-4">
        <div class="w-full max-w-sm">
            <!-- Logo and Title -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 rounded-xl mb-3 shadow-lg">
                    <i class="fas fa-school text-white text-2xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-white mb-1">Sarana Sekolah</h1>
                <p class="text-blue-100 text-sm">Sistem Pengaduan Suara Sarana Sekolah</p>
            </div>

            <!-- Login Card -->
            <div class="glass-container rounded-2xl p-5">
                <!-- Tab Navigation -->
                <div class="flex mb-4 bg-white/10 rounded-lg p-1">
                    <button type="button" id="adminTab" class="flex-1 py-2 px-3 rounded-md text-xs font-medium transition-all duration-200 bg-white/20 text-white" onclick="switchTab('admin')">
                        <i class="fas fa-user-shield mr-1"></i>Admin
                    </button>
                    <button type="button" id="siswaTab" class="flex-1 py-2 px-3 rounded-md text-xs font-medium transition-all duration-200 text-blue-100 hover:text-white" onclick="switchTab('siswa')">
                        <i class="fas fa-user-graduate mr-1"></i>Siswa
                    </button>
                </div>

                <!-- Admin Login Form -->
                <form id="adminForm" action="{{ route('login.post') }}" method="POST" class="space-y-3">
                    @csrf
                    @if ($errors->any())
                        <div class="bg-red-500/20 border border-red-500/50 rounded-lg p-2 text-red-100 text-xs">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif
                    
                    <div>
                        <label class="block text-blue-100 text-xs font-medium mb-1" for="email">
                            <i class="fas fa-envelope mr-1"></i>Email
                        </label>
                        <input 
                            name="email"
                            type="email" 
                            id="email" 
                            class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-200 text-sm"
                            placeholder="admin@sekolah.sch.id"
                            required
                        >
                    </div>

                    <div>
                        <label class="block text-blue-100 text-xs font-medium mb-1" for="password">
                            <i class="fas fa-lock mr-1"></i>Password
                        </label>
                        <input 
                            name="password"
                            type="password" 
                            id="password" 
                            class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-200 text-sm"
                            placeholder="Masukkan password"
                            required
                        >
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg text-sm">
                        <i class="fas fa-sign-in-alt mr-1"></i>Masuk Admin
                    </button>
                </form>

                <!-- Siswa Login Form -->
                <form id="siswaForm" action="{{ route('login.siswa.post') }}" method="POST" class="space-y-3 hidden">
                    @csrf
                    @if ($errors->any())
                        <div class="bg-red-500/20 border border-red-500/50 rounded-lg p-2 text-red-100 text-xs">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif
                    
                    <div>
                        <label class="block text-blue-100 text-xs font-medium mb-1" for="nisn">
                            <i class="fas fa-id-card mr-1"></i>NISN
                        </label>
                        <input 
                            name="nisn"
                            type="text" 
                            id="nisn" 
                            class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition-all duration-200 text-sm"
                            placeholder="Masukkan NISN"
                            required
                        >
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg text-sm">
                        <i class="fas fa-sign-in-alt mr-1"></i>Masuk Siswa
                    </button>
                </form>

                <!-- Footer Info -->
                <div class="mt-4 pt-3 border-t border-white/20 text-center">
                    <p class="text-blue-100 text-xs">
                        <i class="fas fa-info-circle mr-1"></i>
                        Hubungi admin untuk bantuan
                    </p>
                </div>
            </div>

            <!-- Copyright -->
            <div class="text-center mt-4">
                <p class="text-blue-100 text-xs">
                    2024 Sarana Sekolah. All rights reserved.
                </p>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tab) {
            const adminTab = document.getElementById('adminTab');
            const siswaTab = document.getElementById('siswaTab');
            const adminForm = document.getElementById('adminForm');
            const siswaForm = document.getElementById('siswaForm');

            if (tab === 'admin') {
                adminTab.classList.add('bg-white/20', 'text-white');
                adminTab.classList.remove('text-blue-100');
                siswaTab.classList.remove('bg-white/20', 'text-white');
                siswaTab.classList.add('text-blue-100');
                
                adminForm.classList.remove('hidden');
                siswaForm.classList.add('hidden');
            } else {
                siswaTab.classList.add('bg-white/20', 'text-white');
                siswaTab.classList.remove('text-blue-100');
                adminTab.classList.remove('bg-white/20', 'text-white');
                adminTab.classList.add('text-blue-100');
                
                siswaForm.classList.remove('hidden');
                adminForm.classList.add('hidden');
            }
        }

        // Clear errors when switching tabs
        document.addEventListener('DOMContentLoaded', function() {
            const adminTab = document.getElementById('adminTab');
            const siswaTab = document.getElementById('siswaTab');
            
            adminTab.addEventListener('click', function() {
                // Clear any error messages
                const errorDivs = document.querySelectorAll('.bg-red-500\\/20');
                errorDivs.forEach(div => div.remove());
            });
            
            siswaTab.addEventListener('click', function() {
                // Clear any error messages
                const errorDivs = document.querySelectorAll('.bg-red-500\\/20');
                errorDivs.forEach(div => div.remove());
            });
        });
    </script>
</body>
</html>