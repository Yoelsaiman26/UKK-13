@extends('layouts.app')

@section('title', 'Dashboard - Pengaduan Suara Sarana Sekolah')

@section('content')
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-6 text-white">
        <h2 class="text-2xl font-bold mb-2">Selamat Datang di Dashboard Pengaduan</h2>
        <p class="text-blue-100">Sistem Pengaduan Suara Sarana Sekolah - Kelola semua pengaduan sarana dan prasarana sekolah dengan mudah</p>
    </div>
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
        <!-- Total Pengaduan -->
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm text-gray-600 mb-1">Total Aspirasi</p>
                    <p class="text-xl sm:text-2xl font-bold text-gray-800">{{ $totalAspirasi }}</p>
                    <p class="text-xs text-green-600 mt-2">
                        <i class="fas fa-arrow-up"></i> 12% dari bulan lalu
                    </p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 rounded-lg flex items-center justify-center ml-3">
                    <i class="fas fa-comment-dots text-blue-600 text-lg sm:text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Pengaduan Menunggu -->
        <div class="bg-white rounded-lg shadow p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm text-gray-600 mb-1">Aspirasi Pending</p>
                    <p class="text-xl sm:text-2xl font-bold text-gray-800">{{ $pendingAspirasi }}</p>
                    <p class="text-xs text-orange-600 mt-2">
                        <i class="fas fa-clock"></i> Perlu ditindak
                    </p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-orange-100 rounded-lg flex items-center justify-center ml-3">
                    <i class="fas fa-hourglass-half text-orange-600 text-lg sm:text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Sedang Diproses -->
        <div class="bg-white rounded-lg shadow p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm text-gray-600 mb-1">Asprasi Diproses</p>
                    <p class="text-xl sm:text-2xl font-bold text-gray-800">{{ $prosesAspirasi }}</p>
                    <p class="text-xs text-blue-600 mt-2">
                        <i class="fas fa-spinner"></i> Dalam proses
                    </p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 rounded-lg flex items-center justify-center ml-3">
                    <i class="fas fa-tools text-blue-600 text-lg sm:text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Selesai -->
        <div class="bg-white rounded-lg shadow p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm text-gray-600 mb-1">Aspirasi Selesai</p>
                    <p class="text-xl sm:text-2xl font-bold text-gray-800">{{ $selesaiAspirasi }}</p>
                    <p class="text-xs text-green-600 mt-2">
                        <i class="fas fa-check-circle"></i> 73.7% selesai
                    </p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-green-100 rounded-lg flex items-center justify-center ml-3">
                    <i class="fas fa-check text-green-600 text-lg sm:text-xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
        <!-- Pengaduan Chart -->
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <h3 class="text-base md:text-lg font-semibold text-gray-800 mb-3 md:mb-4">Grafik Aspirasi Mingguan - {{ now()->format('F Y') }}</h3>
            <div class="h-48 md:h-64 relative">
                <canvas id="weeklyChart"></canvas>
            </div>
        </div>
        
        <!-- Kategori Pengaduan -->
        <div class="bg-white rounded-lg shadow p-4 md:p-6">
            <h3 class="text-base md:text-lg font-semibold text-gray-800 mb-3 md:mb-4">Pengaduan per Kategori</h3>
            <div class="space-y-2 md:space-y-3">
                @foreach($kategori as $item)
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2 md:space-x-3">
                        <div class="w-2 h-2 md:w-3 md:h-3 bg-blue-500 rounded-full"></div>
                        <span class="text-xs md:text-sm text-gray-700">{{ $item['name'] }}</span>
                    </div>
                    <span class="text-xs md:text-sm font-medium">{{ $item['count'] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <!-- Recent Pengaduan Table -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-4 md:px-6 py-3 md:py-4 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <h3 class="text-base md:text-lg font-semibold text-gray-800">Pengaduan Terbaru</h3>
                <a href="{{ route('pengaduan.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium inline-flex items-center">
                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[500px]">
                <thead class="bg-gray-50">
                    <tr>
                        {{-- <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th> --}}
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelapor</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Judul</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if($aspirasi->count() > 0)
                        @foreach($aspirasi as $aspirasi)
                        <tr>
                            {{-- <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-900">#001</td> --}}
                            <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-900">{{ $aspirasi->siswa->nama }}</td>
                            <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-900">{{ $aspirasi->kategori->nama }}</td>
                            <td class="px-3 md:px-6 py-2 md:py-4 text-sm text-gray-900 hidden sm:table-cell">{{ $aspirasi->judul }}</td>
                            <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap">
                                @if($aspirasi->status == 'pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                        Pending
                                    </span>
                                @elseif($aspirasi->status == 'diproses')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Diproses
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Selesai
                                    </span>
                                @endif
                            </td>
                            <td class="px-3 md:px-6 py-2 md:py-4 whitespace-nowrap text-sm text-gray-500">{{ $aspirasi->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-inbox text-4xl text-gray-300 mb-3"></i>
                                    <p class="text-lg font-medium text-gray-600">Belum ada aspirasi</p>
                                    <p class="text-sm text-gray-500 mt-1">Mulai buat aspirasi pertama Anda</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize weekly chart
    const ctx = document.getElementById('weeklyChart').getContext('2d');
    const weeklyChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($weeklyData['labels']),
            datasets: [{
                label: 'Jumlah Aspirasi',
                data: @json($weeklyData['data']),
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: 'rgb(59, 130, 246)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: 'rgb(59, 130, 246)',
                    borderWidth: 1,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Aspirasi: ' + context.parsed.y + ' buah';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        color: '#6b7280',
                        font: {
                            size: 11
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    ticks: {
                        color: '#6b7280',
                        font: {
                            size: 11
                        }
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Real-time update functionality
    function updateChartData() {
        fetch('{{ route("dashboard") }}/weekly-data')
            .then(response => response.json())
            .then(data => {
                weeklyChart.data.datasets[0].data = data.data;
                weeklyChart.update('none'); // Update without animation for smooth real-time feel
            })
            .catch(error => {
                console.error('Error updating chart:', error);
            });
    }

    // Update chart every 30 seconds for real-time effect
    setInterval(updateChartData, 30000);
    
    // Also update when page becomes visible again (tab switch)
    document.addEventListener('visibilitychange', function() {
        if (!document.hidden) {
            updateChartData();
        }
    });
});
</script>
@endpush
