@extends('layouts.app')

@section('title', 'Dashboard TaksiKu')
@section('header', 'Dashboard')
@section('subheader', 'Selamat datang kembali, Administrator Sistem. Berikut yang terjadi hari ini.')
@section('action-button', 'Pesanan Baru')

@push('styles')
<style>
    .stat-card {
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }

    .tab-button {
        padding: 8px 16px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        background: white;
        color: #6b7280;
        font-size: 12px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .tab-button.active,
    .tab-button:hover {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border-color: var(--primary);
    }

    .activity-item {
        padding: 12px 0;
        border-bottom: 1px solid #f3f4f6;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .order-row:hover {
        background-color: #f9fafb;
    }

    .status-completed {
        background: linear-gradient(135deg, #10B981, #059669);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 500;
    }

    .status-pending {
        background: linear-gradient(135deg, #F59E0B, #D97706);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 500;
    }

    .status-cancelled {
        background: linear-gradient(135deg, #EF4444, #DC2626);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 500;
    }

    .progress-bar {
        background: #e5e7eb;
        height: 4px;
        border-radius: 2px;
        overflow: hidden;
    }

    .progress-fill {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        height: 100%;
        transition: width 0.3s ease;
    }

    .dropdown-menu {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        border: 1px solid #e5e7eb;
        padding: 8px 0;
    }

    .dropdown-item {
        padding: 10px 16px;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background: #f3f4f6;
    }
</style>
@endpush

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="stat-card card p-6 text-gray-800" style="background: #ffffff; border: 1px solid #e5e7eb;">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Total Pengguna</p>
                <p class="text-3xl font-bold mt-2">1,200</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">trending_up</span>
                    <span class="text-xs ml-1">12% dari bulan lalu</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">groups</span>
            </div>
        </div>
    </div>

    <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Total Driver</p>
                <p class="text-3xl font-bold mt-2">150</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">trending_up</span>
                    <span class="text-xs ml-1">8% dari bulan lalu</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">person</span>
            </div>
        </div>
    </div>

    <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Total Pesanan</p>
                <p class="text-3xl font-bold mt-2">1,250</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">trending_up</span>
                    <span class="text-xs ml-1">23% dari bulan lalu</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">receipt_long</span>
            </div>
        </div>
    </div>

    <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Total Pendapatan</p>
                <p class="text-3xl font-bold mt-2">Rp 2.3M</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">trending_up</span>
                    <span class="text-xs ml-1">18% dari bulan lalu</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">attach_money</span>
            </div>
        </div>
    </div>
</div>

<!-- Charts and Tables -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Revenue Chart -->
    <div class="lg:col-span-2 card p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Ringkasan Pendapatan</h3>
            <div class="flex space-x-2">
                <button class="tab-button active">Minggu</button>
                <button class="tab-button">Bulan</button>
                <button class="tab-button">Tahun</button>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="card p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Terkini</h3>
        <div class="space-y-4">
            <div class="activity-item">
                <p class="text-sm font-medium">Pesanan baru #85743</p>
                <p class="text-xs text-gray-500">2 menit yang lalu</p>
            </div>
            <div class="activity-item">
                <p class="text-sm font-medium">Driver terdaftar</p>
                <p class="text-xs text-gray-500">15 menit yang lalu</p>
            </div>
            <div class="activity-item">
                <p class="text-sm font-medium">Pembayaran diterima</p>
                <p class="text-xs text-gray-500">1 jam yang lalu</p>
            </div>
            <div class="activity-item">
                <p class="text-sm font-medium">Pengguna baru terdaftar</p>
                <p class="text-xs text-gray-500">2 jam yang lalu</p>
            </div>
            <div class="activity-item">
                <p class="text-sm font-medium">Pesanan #85740 selesai</p>
                <p class="text-xs text-gray-500">3 jam yang lalu</p>
            </div>
        </div>
    </div>
</div>

<!-- Orders Table -->
<div class="card p-6 mb-8">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Pesanan Terkini</h3>
        <a class="text-sm text-blue-600 hover:underline" href="#">Lihat Semua</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-800">
            <thead class="border-b border-gray-200 text-xs uppercase text-gray-500">
                <tr>
                    <th class="py-3 px-4" scope="col">ID Pesanan</th>
                    <th class="py-3 px-4" scope="col">Pelanggan</th>
                    <th class="py-3 px-4" scope="col">Driver</th>
                    <th class="py-3 px-4" scope="col">Tanggal</th>
                    <th class="py-3 px-4" scope="col">Jumlah</th>
                    <th class="py-3 px-4" scope="col">Status</th>
                    <th class="py-3 px-4" scope="col">Progress</th>
                    <th class="py-3 px-4" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="order-row border-b border-gray-200">
                    <td class="py-4 px-4 font-medium text-gray-900">#85742</td>
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <img alt="Sarah Johnson" class="w-8 h-8 rounded-full mr-3" src="https://picsum.photos/seed/sarah/40/40.jpg">
                            <div>
                                <div class="text-gray-900 font-medium">Sarah Johnson</div>
                                <div class="text-gray-500 text-xs">sarah.j@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <img alt="Michael Brown" class="w-8 h-8 rounded-full mr-3" src="https://picsum.photos/seed/michael/40/40.jpg">
                            <div>
                                <div class="text-gray-900 font-medium">Michael Brown</div>
                                <div class="text-gray-500 text-xs">Toyota Camry</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4 text-gray-900">20 Agt 2024</td>
                    <td class="py-4 px-4 text-gray-900">Rp 65.000</td>
                    <td class="py-4 px-4">
                        <span class="status-completed">Selesai</span>
                    </td>
                    <td class="py-4 px-4">
                        <div class="progress-bar w-full">
                            <div class="progress-fill" style="width: 100%"></div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-900" onclick="toggleDropdown('order-1')">
                                <span class="material-icons-round text-base">more_vert</span>
                            </button>
                            <div id="order-1" class="hidden absolute right-0 mt-2 w-48 dropdown-menu z-10">
                                <a href="#" class="block dropdown-item text-sm text-gray-700">Lihat Detail</a>
                                <a href="#" class="block dropdown-item text-sm text-gray-700">Unduh Invoice</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="order-row border-b border-gray-200">
                    <td class="py-4 px-4 font-medium text-gray-900">#85741</td>
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <img alt="David Wilson" class="w-8 h-8 rounded-full mr-3" src="https://picsum.photos/seed/david/40/40.jpg">
                            <div>
                                <div class="text-gray-900 font-medium">David Wilson</div>
                                <div class="text-gray-500 text-xs">david.w@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <img alt="Robert Johnson" class="w-8 h-8 rounded-full mr-3" src="https://picsum.photos/seed/robert/40/40.jpg">
                            <div>
                                <div class="text-gray-900 font-medium">Robert Johnson</div>
                                <div class="text-gray-500 text-xs">Honda Accord</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4 text-gray-900">20 Agt 2024</td>
                    <td class="py-4 px-4 text-gray-900">Rp 45.000</td>
                    <td class="py-4 px-4">
                        <span class="status-cancelled">Dibatalkan</span>
                    </td>
                    <td class="py-4 px-4">
                        <div class="progress-bar w-full">
                            <div class="progress-fill bg-red-500" style="width: 30%"></div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-900" onclick="toggleDropdown('order-2')">
                                <span class="material-icons-round text-base">more_vert</span>
                            </button>
                            <div id="order-2" class="hidden absolute right-0 mt-2 w-48 dropdown-menu z-10">
                                <a href="#" class="block dropdown-item text-sm text-gray-700">Lihat Detail</a>
                                <a href="#" class="block dropdown-item text-sm text-gray-700">Unduh Invoice</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="order-row border-b border-gray-200">
                    <td class="py-4 px-4 font-medium text-gray-900">#85739</td>
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <img alt="Emily Davis" class="w-8 h-8 rounded-full mr-3" src="https://picsum.photos/seed/emily/40/40.jpg">
                            <div>
                                <div class="text-gray-900 font-medium">Emily Davis</div>
                                <div class="text-gray-500 text-xs">emily.d@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <img alt="James Wilson" class="w-8 h-8 rounded-full mr-3" src="https://picsum.photos/seed/james/40/40.jpg">
                            <div>
                                <div class="text-gray-900 font-medium">James Wilson</div>
                                <div class="text-gray-500 text-xs">BMW 3 Series</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4 text-gray-900">19 Agt 2024</td>
                    <td class="py-4 px-4 text-gray-900">Rp 80.000</td>
                    <td class="py-4 px-4">
                        <span class="status-pending">Dalam Perjalanan</span>
                    </td>
                    <td class="py-4 px-4">
                        <div class="progress-bar w-full">
                            <div class="progress-fill bg-yellow-500" style="width: 70%"></div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-900" onclick="toggleDropdown('order-3')">
                                <span class="material-icons-round text-base">more_vert</span>
                            </button>
                            <div id="order-3" class="hidden absolute right-0 mt-2 w-48 dropdown-menu z-10">
                                <a href="#" class="block dropdown-item text-sm text-gray-700">Lihat Detail</a>
                                <a href="#" class="block dropdown-item text-sm text-gray-700">Hubungi Driver</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        dropdown.classList.toggle('hidden');
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        const dropdowns = document.querySelectorAll('.dropdown-menu');
        dropdowns.forEach(dropdown => {
            if (!dropdown.parentNode.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });

    // Initialize chart
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [{
                    label: 'Pendapatan',
                    data: [650000, 890000, 1200000, 1400000, 1300000, 1700000, 1800000],
                    backgroundColor: 'rgba(99, 102, 241, 0.7)',
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                    barThickness: 20
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
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            drawBorder: false,
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
