@extends('layouts.app')

@section('title', 'TaksiKu - Manajemen Pengguna')
@section('header', 'Manajemen Pengguna')
@section('subheader', 'Kelola data pengguna dan driver dalam sistem TaksiKu')
@section('action-button', 'Tambah Pengguna')

@push('styles')
<style>
    .stat-card {
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .user-role-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 500;
    }

    .role-admin {
        background: linear-gradient(135deg, #F59E0B, #F97316);
        color: white;
    }

    .role-driver {
        background: linear-gradient(135deg, #EF4444, #DC2626);
        color: white;
    }

    .role-customer {
        background: linear-gradient(135deg, #3B82F6, #2563EB);
        color: white;
    }

    .role-operator {
        background: linear-gradient(135deg, #8B5CF6, #7C3AED);
        color: white;
    }

    .role-manager {
        background: linear-gradient(135deg, #10B981, #059669);
        color: white;
    }

    .role-support {
        background: linear-gradient(135deg, #14B8A6, #0D9488);
        color: white;
    }

    .user-row:hover {
        background-color: #f9fafb;
    }

    .status-active {
        background: linear-gradient(135deg, #10B981, #059669);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 500;
    }

    .status-inactive {
        background: linear-gradient(135deg, #EF4444, #DC2626);
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

    .filter-button {
        padding: 8px 16px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        background: white;
        color: #6b7280;
        font-size: 12px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .filter-button.active,
    .filter-button:hover {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border-color: var(--primary);
    }
</style>
@endpush

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="card p-6 text-white" style="background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Total Pengguna</p>
                <p class="text-3xl font-bold mt-2">2,847</p>
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

    <div class="card p-6 text-white" style="background: linear-gradient(135deg, #10B981 0%, #14B8A6 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Driver Aktif</p>
                <p class="text-3xl font-bold mt-2">156</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">trending_up</span>
                    <span class="text-xs ml-1">8% dari bulan lalu</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">drive_eta</span>
            </div>
        </div>
    </div>

    <div class="card p-6 text-white" style="background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Pengguna Baru</p>
                <p class="text-3xl font-bold mt-2">47</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">trending_up</span>
                    <span class="text-xs ml-1">23% dari bulan lalu</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">person_add</span>
            </div>
        </div>
    </div>

    <div class="card p-6 text-white" style="background: linear-gradient(135deg, #F59E0B 0%, #F97316 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Pending Verifikasi</p>
                <p class="text-3xl font-bold mt-2">12</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">trending_down</span>
                    <span class="text-xs ml-1">5% dari bulan lalu</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">pending</span>
            </div>
        </div>
    </div>
</div>

<!-- Users Table -->
<div class="card p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-800">Daftar Pengguna</h3>
        <div class="flex items-center space-x-4">
            <div class="flex space-x-2">
                <button class="filter-button active">Semua</button>
                <button class="filter-button">Admin</button>
                <button class="filter-button">Driver</button>
                <button class="filter-button">Customer</button>
            </div>
            <button class="btn-primary px-4 py-2 font-medium flex items-center">
                <span class="material-icons-round text-sm mr-1">add</span>
                Tambah Pengguna
            </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-800">
            <thead class="border-b border-gray-200 text-xs uppercase text-gray-500">
                <tr>
                    <th class="py-3 px-4" scope="col">
                        <input type="checkbox" class="rounded">
                    </th>
                    <th class="py-3 px-4" scope="col">Pengguna</th>
                    <th class="py-3 px-4" scope="col">Role</th>
                    <th class="py-3 px-4" scope="col">Status</th>
                    <th class="py-3 px-4" scope="col">Bergabung</th>
                    <th class="py-3 px-4" scope="col">Terakhir Login</th>
                    <th class="py-3 px-4" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="user-row border-b border-gray-200">
                    <td class="py-4 px-4">
                        <input type="checkbox" class="rounded">
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <img alt="John Doe" class="w-10 h-10 rounded-full mr-3" src="https://picsum.photos/seed/john/40/40.jpg">
                            <div>
                                <div class="text-gray-900 font-medium">John Doe</div>
                                <div class="text-gray-500 text-xs">john.doe@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <span class="user-role-badge role-admin">Admin</span>
                    </td>
                    <td class="py-4 px-4">
                        <span class="status-active">Aktif</span>
                    </td>
                    <td class="py-4 px-4 text-gray-900">15 Jan 2024</td>
                    <td class="py-4 px-4 text-gray-900">2 jam yang lalu</td>
                    <td class="py-4 px-4">
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-900" onclick="toggleDropdown('user-1')">
                                <span class="material-icons-round text-base">more_vert</span>
                            </button>
                            <div id="user-1" class="hidden absolute right-0 mt-2 w-48 dropdown-menu z-10">
                                <a href="#" class="block dropdown-item text-sm text-gray-700">Lihat Detail</a>
                                <a href="#" class="block dropdown-item text-sm text-gray-700">Edit Pengguna</a>
                                <a href="#" class="block dropdown-item text-sm text-red-600">Hapus</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="user-row border-b border-gray-200">
                    <td class="py-4 px-4">
                        <input type="checkbox" class="rounded">
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <img alt="Jane Smith" class="w-10 h-10 rounded-full mr-3" src="https://picsum.photos/seed/jane/40/40.jpg">
                            <div>
                                <div class="text-gray-900 font-medium">Jane Smith</div>
                                <div class="text-gray-500 text-xs">jane.smith@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <span class="user-role-badge role-driver">Driver</span>
                    </td>
                    <td class="py-4 px-4">
                        <span class="status-active">Aktif</span>
                    </td>
                    <td class="py-4 px-4 text-gray-900">10 Feb 2024</td>
                    <td class="py-4 px-4 text-gray-900">30 menit yang lalu</td>
                    <td class="py-4 px-4">
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-900" onclick="toggleDropdown('user-2')">
                                <span class="material-icons-round text-base">more_vert</span>
                            </button>
                            <div id="user-2" class="hidden absolute right-0 mt-2 w-48 dropdown-menu z-10">
                                <a href="#" class="block dropdown-item text-sm text-gray-700">Lihat Detail</a>
                                <a href="#" class="block dropdown-item text-sm text-gray-700">Edit Pengguna</a>
                                <a href="#" class="block dropdown-item text-sm text-red-600">Hapus</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="user-row border-b border-gray-200">
                    <td class="py-4 px-4">
                        <input type="checkbox" class="rounded">
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <img alt="Mike Johnson" class="w-10 h-10 rounded-full mr-3" src="https://picsum.photos/seed/mike/40/40.jpg">
                            <div>
                                <div class="text-gray-900 font-medium">Mike Johnson</div>
                                <div class="text-gray-500 text-xs">mike.johnson@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <span class="user-role-badge role-customer">Customer</span>
                    </td>
                    <td class="py-4 px-4">
                        <span class="status-pending">Pending</span>
                    </td>
                    <td class="py-4 px-4 text-gray-900">05 Mar 2024</td>
                    <td class="py-4 px-4 text-gray-900">Belum pernah</td>
                    <td class="py-4 px-4">
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-900" onclick="toggleDropdown('user-3')">
                                <span class="material-icons-round text-base">more_vert</span>
                            </button>
                            <div id="user-3" class="hidden absolute right-0 mt-2 w-48 dropdown-menu z-10">
                                <a href="#" class="block dropdown-item text-sm text-gray-700">Approve</a>
                                <a href="#" class="block dropdown-item text-sm text-gray-700">Lihat Detail</a>
                                <a href="#" class="block dropdown-item text-sm text-red-600">Reject</a>
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
            Menampilkan 1-10 dari 2,847 pengguna
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
    document.querySelectorAll('.filter-button').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.filter-button').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>
@endpush
