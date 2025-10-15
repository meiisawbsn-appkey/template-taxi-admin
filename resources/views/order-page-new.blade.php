@extends('layouts.app')

@section('title', 'Manajemen Pesanan - TaksiKu')
@section('header', 'Manajemen Pesanan')
@section('subheader', 'Monitor dan kelola semua pesanan taksi')
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

    .order-row {
        transition: all 0.2s ease;
    }

    .order-row:hover {
        background-color: rgba(99, 102, 241, 0.05);
    }

    .status-pending {
        background: linear-gradient(135deg, #F59E0B, #F97316);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .status-ongoing {
        background: linear-gradient(135deg, #3B82F6, #2563EB);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .status-completed {
        background: linear-gradient(135deg, #10B981, #14B8A6);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .status-cancelled {
        background: linear-gradient(135deg, #EF4444, #DC2626);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .dropdown-menu {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .dropdown-item {
        padding: 10px 16px;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: rgba(99, 102, 241, 0.1);
    }

    .filter-btn {
        padding: 8px 16px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        background: white;
        color: #6b7280;
        font-size: 12px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .filter-btn.active,
    .filter-btn:hover {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border-color: var(--primary);
    }

    .location-text {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
@endpush

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #F59E0B 0%, #F97316 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Menunggu Driver</p>
                <p class="text-3xl font-bold mt-2">12</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">hourglass_empty</span>
                    <span class="text-xs ml-1">Pesanan pending</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">hourglass_empty</span>
            </div>
        </div>
    </div>

    <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Sedang Berlangsung</p>
                <p class="text-3xl font-bold mt-2">8</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">directions_car</span>
                    <span class="text-xs ml-1">Trip aktif</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">directions_car</span>
            </div>
        </div>
    </div>

    <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #10B981 0%, #14B8A6 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Selesai Hari Ini</p>
                <p class="text-3xl font-bold mt-2">47</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">check_circle</span>
                    <span class="text-xs ml-1">15% dari kemarin</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">check_circle</span>
            </div>
        </div>
    </div>

    <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Total Pendapatan</p>
                <p class="text-3xl font-bold mt-2">Rp 2.8M</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">trending_up</span>
                    <span class="text-xs ml-1">Hari ini</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">payments</span>
            </div>
        </div>
    </div>
</div>

<!-- Orders Table -->
<div class="card p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-800">Pesanan Terbaru</h3>
        <div class="flex items-center space-x-4">
            <div class="flex space-x-2">
                <button class="filter-btn active">Semua</button>
                <button class="filter-btn">Pending</button>
                <button class="filter-btn">Ongoing</button>
                <button class="filter-btn">Completed</button>
            </div>
            <button class="btn-primary px-4 py-2 font-medium flex items-center">
                <span class="material-icons-round text-sm mr-1">add</span>
                Pesanan Baru
            </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-800">
            <thead class="border-b border-gray-200 text-xs uppercase text-gray-500">
                <tr>
                    <th class="py-3 px-4" scope="col">ID Pesanan</th>
                    <th class="py-3 px-4" scope="col">Customer</th>
                    <th class="py-3 px-4" scope="col">Driver</th>
                    <th class="py-3 px-4" scope="col">Rute</th>
                    <th class="py-3 px-4" scope="col">Tarif</th>
                    <th class="py-3 px-4" scope="col">Status</th>
                    <th class="py-3 px-4" scope="col">Waktu</th>
                    <th class="py-3 px-4" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="order-row border-b border-gray-200">
                    <td class="py-4 px-4">
                        <div class="text-gray-900 font-medium">#TK2024001</div>
                        <div class="text-gray-500 text-xs">Regular</div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <img alt="Sarah Johnson" class="w-8 h-8 rounded-full mr-2" src="https://picsum.photos/seed/sarah2/32/32.jpg">
                            <div>
                                <div class="text-gray-900 font-medium">Sarah Johnson</div>
                                <div class="text-gray-500 text-xs">+62 812-3456-7890</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <img alt="Ahmad Rifai" class="w-8 h-8 rounded-full mr-2" src="https://picsum.photos/seed/ahmad3/32/32.jpg">
                            <div>
                                <div class="text-gray-900 font-medium">Ahmad Rifai</div>
                                <div class="text-gray-500 text-xs">B 1234 XYZ</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="location-text text-gray-900 font-medium">Mall Taman Anggrek</div>
                        <div class="location-text text-gray-500 text-xs">→ Bandara Soekarno-Hatta</div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-gray-900 font-medium">Rp 125,000</div>
                        <div class="text-gray-500 text-xs">35.2 km</div>
                    </td>
                    <td class="py-4 px-4">
                        <span class="status-ongoing">Sedang Berlangsung</span>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-gray-900">14:25</div>
                        <div class="text-gray-500 text-xs">15 Mar 2024</div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-900" onclick="toggleDropdown('order-1')">
                                <span class="material-icons-round text-base">more_vert</span>
                            </button>
                            <div id="order-1" class="hidden absolute right-0 mt-2 w-48 dropdown-menu z-10">
                                <a href="#" class="block dropdown-item text-sm text-gray-700">Lihat Detail</a>
                                <a href="#" class="block dropdown-item text-sm text-blue-600">Track Perjalanan</a>
                                <a href="#" class="block dropdown-item text-sm text-green-600">Hubungi Customer</a>
                                <a href="#" class="block dropdown-item text-sm text-red-600">Batalkan</a>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr class="order-row border-b border-gray-200">
                    <td class="py-4 px-4">
                        <div class="text-gray-900 font-medium">#TK2024002</div>
                        <div class="text-gray-500 text-xs">Express</div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <img alt="Budi Santoso" class="w-8 h-8 rounded-full mr-2" src="https://picsum.photos/seed/budi2/32/32.jpg">
                            <div>
                                <div class="text-gray-900 font-medium">Budi Santoso</div>
                                <div class="text-gray-500 text-xs">+62 856-7890-1234</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-gray-500 text-center">
                            <span class="material-icons-round text-sm">search</span>
                            <div class="text-xs">Mencari driver...</div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="location-text text-gray-900 font-medium">Stasiun Gambir</div>
                        <div class="location-text text-gray-500 text-xs">→ Hotel Indonesia</div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-gray-900 font-medium">Rp 45,000</div>
                        <div class="text-gray-500 text-xs">8.5 km</div>
                    </td>
                    <td class="py-4 px-4">
                        <span class="status-pending">Menunggu Driver</span>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-gray-900">14:20</div>
                        <div class="text-gray-500 text-xs">15 Mar 2024</div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-900" onclick="toggleDropdown('order-2')">
                                <span class="material-icons-round text-base">more_vert</span>
                            </button>
                            <div id="order-2" class="hidden absolute right-0 mt-2 w-48 dropdown-menu z-10">
                                <a href="#" class="block dropdown-item text-sm text-gray-700">Lihat Detail</a>
                                <a href="#" class="block dropdown-item text-sm text-blue-600">Assign Driver</a>
                                <a href="#" class="block dropdown-item text-sm text-orange-600">Prioritas Tinggi</a>
                                <a href="#" class="block dropdown-item text-sm text-red-600">Batalkan</a>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr class="order-row border-b border-gray-200">
                    <td class="py-4 px-4">
                        <div class="text-gray-900 font-medium">#TK2024003</div>
                        <div class="text-gray-500 text-xs">Regular</div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <img alt="Linda Sari" class="w-8 h-8 rounded-full mr-2" src="https://picsum.photos/seed/linda2/32/32.jpg">
                            <div>
                                <div class="text-gray-900 font-medium">Linda Sari</div>
                                <div class="text-gray-500 text-xs">+62 878-9012-3456</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <img alt="Sari Dewi" class="w-8 h-8 rounded-full mr-2" src="https://picsum.photos/seed/sari2/32/32.jpg">
                            <div>
                                <div class="text-gray-900 font-medium">Sari Dewi</div>
                                <div class="text-gray-500 text-xs">D 5678 ABC</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="location-text text-gray-900 font-medium">Plaza Indonesia</div>
                        <div class="location-text text-gray-500 text-xs">→ Kemang Village</div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-gray-900 font-medium">Rp 65,000</div>
                        <div class="text-gray-500 text-xs">12.8 km</div>
                    </td>
                    <td class="py-4 px-4">
                        <span class="status-completed">Selesai</span>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-gray-900">13:45</div>
                        <div class="text-gray-500 text-xs">15 Mar 2024</div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-900" onclick="toggleDropdown('order-3')">
                                <span class="material-icons-round text-base">more_vert</span>
                            </button>
                            <div id="order-3" class="hidden absolute right-0 mt-2 w-48 dropdown-menu z-10">
                                <a href="#" class="block dropdown-item text-sm text-gray-700">Lihat Detail</a>
                                <a href="#" class="block dropdown-item text-sm text-blue-600">Invoice</a>
                                <a href="#" class="block dropdown-item text-sm text-green-600">Feedback</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between items-center mt-6">
        <div class="text-sm text-gray-500">
            Menampilkan 1-10 dari 247 pesanan
        </div>
        <div class="flex space-x-2">
            <button class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50">Sebelumnya</button>
            <button class="px-3 py-1 text-sm bg-blue-600 text-white rounded">1</button>
            <button class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50">2</button>
            <button class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50">3</button>
            <button class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50">Selanjutnya</button>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
    <div class="card p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Driver Tersedia</h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <div class="flex items-center">
                    <img alt="Ahmad Rifai" class="w-8 h-8 rounded-full mr-3" src="https://picsum.photos/seed/ahmad4/32/32.jpg">
                    <div>
                        <div class="text-sm font-medium">Ahmad Rifai</div>
                        <div class="text-xs text-gray-500">Daerah: Senayan</div>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Online</span>
                    <button class="text-blue-600 hover:text-blue-800">
                        <span class="material-icons-round text-sm">send</span>
                    </button>
                </div>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <div class="flex items-center">
                    <img alt="Budi Santoso" class="w-8 h-8 rounded-full mr-3" src="https://picsum.photos/seed/budi3/32/32.jpg">
                    <div>
                        <div class="text-sm font-medium">Budi Santoso</div>
                        <div class="text-xs text-gray-500">Daerah: Kemang</div>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Online</span>
                    <button class="text-blue-600 hover:text-blue-800">
                        <span class="material-icons-round text-sm">send</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Statistik Real-time</h3>
        <div class="space-y-4">
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Driver Online</span>
                <span class="text-sm font-medium">45/60</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-green-500 h-2 rounded-full" style="width: 75%"></div>
            </div>

            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Tingkat Keberhasilan</span>
                <span class="text-sm font-medium">92%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-blue-500 h-2 rounded-full" style="width: 92%"></div>
            </div>

            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Waktu Tunggu Rata-rata</span>
                <span class="text-sm font-medium">4.2 menit</span>
            </div>
        </div>
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

    // Filter buttons
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>
@endpush
