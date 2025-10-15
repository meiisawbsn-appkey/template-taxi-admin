@extends('layouts.app')

@section('title', 'Manajemen Kendaraan - TaksiKu')
@section('header', 'Manajemen Kendaraan')
@section('subheader', 'Kelola data kendaraan dan informasi driver')
@section('action-button', 'Tambah Kendaraan')

@push('styles')
<style>
    .stat-card {
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .vehicle-row {
        transition: all 0.2s ease;
    }

    .vehicle-row:hover {
        background-color: rgba(99, 102, 241, 0.05);
    }

    .status-active {
        background: linear-gradient(135deg, #10B981, #14B8A6);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .status-inactive {
        background: linear-gradient(135deg, #EF4444, #DC2626);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .status-maintenance {
        background: linear-gradient(135deg, #F59E0B, #F97316);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
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
</style>
@endpush

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Total Kendaraan</p>
                <p class="text-3xl font-bold mt-2">156</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">directions_car</span>
                    <span class="text-xs ml-1">Terdaftar aktif</span>
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
                <p class="text-sm opacity-80">Sedang Aktif</p>
                <p class="text-3xl font-bold mt-2">89</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">radio_button_checked</span>
                    <span class="text-xs ml-1">Online sekarang</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">radio_button_checked</span>
            </div>
        </div>
    </div>

    <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #F59E0B 0%, #F97316 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Maintenance</p>
                <p class="text-3xl font-bold mt-2">12</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">build</span>
                    <span class="text-xs ml-1">Sedang perbaikan</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">build</span>
            </div>
        </div>
    </div>

    <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Pendapatan Harian</p>
                <p class="text-3xl font-bold mt-2">Rp 2.8M</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">trending_up</span>
                    <span class="text-xs ml-1">15% dari kemarin</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">payments</span>
            </div>
        </div>
    </div>
</div>

<!-- Vehicles Table -->
<div class="card p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-800">Daftar Kendaraan</h3>
        <div class="flex items-center space-x-4">
            <div class="flex space-x-2">
                <button class="filter-btn active">Semua</button>
                <button class="filter-btn">Aktif</button>
                <button class="filter-btn">Maintenance</button>
                <button class="filter-btn">Non-aktif</button>
            </div>
            <button class="btn-primary px-4 py-2 font-medium flex items-center">
                <span class="material-icons-round text-sm mr-1">add</span>
                Tambah Kendaraan
            </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-800">
            <thead class="border-b border-gray-200 text-xs uppercase text-gray-500">
                <tr>
                    <th class="py-3 px-4" scope="col">Plat Nomor</th>
                    <th class="py-3 px-4" scope="col">Driver</th>
                    <th class="py-3 px-4" scope="col">Merk & Model</th>
                    <th class="py-3 px-4" scope="col">Tahun</th>
                    <th class="py-3 px-4" scope="col">Status</th>
                    <th class="py-3 px-4" scope="col">Terakhir Online</th>
                    <th class="py-3 px-4" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="vehicle-row border-b border-gray-200">
                    <td class="py-4 px-4">
                        <div class="text-gray-900 font-medium">B 1234 XYZ</div>
                        <div class="text-gray-500 text-xs">Sedan</div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <img alt="Ahmad Rifai" class="w-10 h-10 rounded-full mr-3" src="https://picsum.photos/seed/ahmad5/40/40.jpg">
                            <div>
                                <div class="text-gray-900 font-medium">Ahmad Rifai</div>
                                <div class="text-gray-500 text-xs">+62 812-3456-7890</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-gray-900 font-medium">Toyota Vios</div>
                        <div class="text-gray-500 text-xs">1.5L Manual</div>
                    </td>
                    <td class="py-4 px-4 text-gray-900">2019</td>
                    <td class="py-4 px-4">
                        <span class="status-active">Aktif</span>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-gray-900">2 jam yang lalu</div>
                        <div class="text-gray-500 text-xs">15 Mar 2024</div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-900" onclick="toggleDropdown('vehicle-1')">
                                <span class="material-icons-round text-base">more_vert</span>
                            </button>
                            <div id="vehicle-1" class="hidden absolute right-0 mt-2 w-48 dropdown-menu z-10">
                                <a href="#" class="block dropdown-item text-sm text-gray-700">Lihat Detail</a>
                                <a href="#" class="block dropdown-item text-sm text-blue-600">Edit Kendaraan</a>
                                <a href="#" class="block dropdown-item text-sm text-orange-600">Set Maintenance</a>
                                <a href="#" class="block dropdown-item text-sm text-red-600">Non-aktifkan</a>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr class="vehicle-row border-b border-gray-200">
                    <td class="py-4 px-4">
                        <div class="text-gray-900 font-medium">D 5678 ABC</div>
                        <div class="text-gray-500 text-xs">MPV</div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <img alt="Sari Dewi" class="w-10 h-10 rounded-full mr-3" src="https://picsum.photos/seed/sari3/40/40.jpg">
                            <div>
                                <div class="text-gray-900 font-medium">Sari Dewi</div>
                                <div class="text-gray-500 text-xs">+62 856-7890-1234</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-gray-900 font-medium">Honda Mobilio</div>
                        <div class="text-gray-500 text-xs">1.5L CVT</div>
                    </td>
                    <td class="py-4 px-4 text-gray-900">2020</td>
                    <td class="py-4 px-4">
                        <span class="status-maintenance">Maintenance</span>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-gray-900">1 hari yang lalu</div>
                        <div class="text-gray-500 text-xs">14 Mar 2024</div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-900" onclick="toggleDropdown('vehicle-2')">
                                <span class="material-icons-round text-base">more_vert</span>
                            </button>
                            <div id="vehicle-2" class="hidden absolute right-0 mt-2 w-48 dropdown-menu z-10">
                                <a href="#" class="block dropdown-item text-sm text-gray-700">Lihat Detail</a>
                                <a href="#" class="block dropdown-item text-sm text-green-600">Selesai Maintenance</a>
                                <a href="#" class="block dropdown-item text-sm text-blue-600">Update Status</a>
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
            Menampilkan 1-10 dari 156 kendaraan
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
