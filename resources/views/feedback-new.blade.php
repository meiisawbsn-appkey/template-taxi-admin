@extends('layouts.app')

@section('title', 'Manajemen Umpan Balik - TaksiKu')
@section('header', 'Manajemen Umpan Balik')
@section('subheader', 'Monitor dan kelola umpan balik dari pengguna dan driver')
@section('action-button', 'Lihat Laporan')

@push('styles')
<style>
    .stat-card {
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .rating-stars {
        display: flex;
        align-items: center;
    }

    .star {
        color: #fbbf24;
        font-size: 14px;
    }

    .star.empty {
        color: #d1d5db;
    }

    .feedback-row {
        transition: all 0.2s ease;
    }

    .feedback-row:hover {
        background-color: rgba(99, 102, 241, 0.05);
    }

    .priority-high {
        background: linear-gradient(135deg, #EF4444, #DC2626);
        color: white;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: 600;
    }

    .priority-medium {
        background: linear-gradient(135deg, #F59E0B, #F97316);
        color: white;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: 600;
    }

    .priority-low {
        background: linear-gradient(135deg, #10B981, #14B8A6);
        color: white;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: 600;
    }

    .status-open {
        background: linear-gradient(135deg, #3B82F6, #2563EB);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .status-resolved {
        background: linear-gradient(135deg, #10B981, #14B8A6);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .status-pending {
        background: linear-gradient(135deg, #F59E0B, #F97316);
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

    .feedback-text {
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
@endpush

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Total Umpan Balik</p>
                <p class="text-3xl font-bold mt-2">847</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">feedback</span>
                    <span class="text-xs ml-1">15% dari bulan lalu</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">feedback</span>
            </div>
        </div>
    </div>

    <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #10B981 0%, #14B8A6 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Rating Rata-rata</p>
                <p class="text-3xl font-bold mt-2">4.6</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">star</span>
                    <span class="text-xs ml-1">Meningkat 0.2 poin</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">star</span>
            </div>
        </div>
    </div>

    <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #F59E0B 0%, #F97316 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Menunggu Respon</p>
                <p class="text-3xl font-bold mt-2">23</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">pending</span>
                    <span class="text-xs ml-1">Perlu ditindaklanjuti</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">pending</span>
            </div>
        </div>
    </div>

    <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Keluhan Tinggi</p>
                <p class="text-3xl font-bold mt-2">7</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">priority_high</span>
                    <span class="text-xs ml-1">Prioritas tinggi</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">priority_high</span>
            </div>
        </div>
    </div>
</div>

<!-- Feedback Table -->
<div class="card p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-800">Umpan Balik Terbaru</h3>
        <div class="flex items-center space-x-4">
            <div class="flex space-x-2">
                <button class="filter-btn active">Semua</button>
                <button class="filter-btn">Pending</button>
                <button class="filter-btn">Resolved</button>
                <button class="filter-btn">High Priority</button>
            </div>
            <button class="btn-primary px-4 py-2 font-medium flex items-center">
                <span class="material-icons-round text-sm mr-1">analytics</span>
                Lihat Laporan
            </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-800">
            <thead class="border-b border-gray-200 text-xs uppercase text-gray-500">
                <tr>
                    <th class="py-3 px-4" scope="col">Pengguna</th>
                    <th class="py-3 px-4" scope="col">Rating</th>
                    <th class="py-3 px-4" scope="col">Umpan Balik</th>
                    <th class="py-3 px-4" scope="col">Kategori</th>
                    <th class="py-3 px-4" scope="col">Prioritas</th>
                    <th class="py-3 px-4" scope="col">Status</th>
                    <th class="py-3 px-4" scope="col">Tanggal</th>
                    <th class="py-3 px-4" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="feedback-row border-b border-gray-200">
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <img alt="Sarah Johnson" class="w-10 h-10 rounded-full mr-3" src="https://picsum.photos/seed/sarah/40/40.jpg">
                            <div>
                                <div class="text-gray-900 font-medium">Sarah Johnson</div>
                                <div class="text-gray-500 text-xs">Customer</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="rating-stars">
                            <span class="star material-icons-round">star</span>
                            <span class="star material-icons-round">star</span>
                            <span class="star material-icons-round">star</span>
                            <span class="star material-icons-round">star</span>
                            <span class="star material-icons-round">star</span>
                            <span class="text-xs text-gray-500 ml-1">(5.0)</span>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="feedback-text text-gray-900">Driver sangat ramah dan profesional. Perjalanan sangat nyaman dan aman.</div>
                        <div class="text-gray-500 text-xs mt-1">Trip #TK2024001</div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-gray-900">Service</div>
                    </td>
                    <td class="py-4 px-4">
                        <span class="priority-low">Low</span>
                    </td>
                    <td class="py-4 px-4">
                        <span class="status-resolved">Resolved</span>
                    </td>
                    <td class="py-4 px-4 text-gray-900">15 Mar 2024</td>
                    <td class="py-4 px-4">
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-900" onclick="toggleDropdown('feedback-1')">
                                <span class="material-icons-round text-base">more_vert</span>
                            </button>
                            <div id="feedback-1" class="hidden absolute right-0 mt-2 w-48 dropdown-menu z-10">
                                <a href="#" class="block dropdown-item text-sm text-gray-700">Lihat Detail</a>
                                <a href="#" class="block dropdown-item text-sm text-blue-600">Balas</a>
                                <a href="#" class="block dropdown-item text-sm text-green-600">Tandai Resolved</a>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr class="feedback-row border-b border-gray-200">
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <img alt="Ahmad Rahman" class="w-10 h-10 rounded-full mr-3" src="https://picsum.photos/seed/ahmad2/40/40.jpg">
                            <div>
                                <div class="text-gray-900 font-medium">Ahmad Rahman</div>
                                <div class="text-gray-500 text-xs">Driver</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="rating-stars">
                            <span class="star material-icons-round">star</span>
                            <span class="star material-icons-round">star</span>
                            <span class="star empty material-icons-round">star</span>
                            <span class="star empty material-icons-round">star</span>
                            <span class="star empty material-icons-round">star</span>
                            <span class="text-xs text-gray-500 ml-1">(2.0)</span>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="feedback-text text-gray-900">Aplikasi sering error dan susah mendapatkan order. Mohon diperbaiki sistem.</div>
                        <div class="text-gray-500 text-xs mt-1">Driver App Issue</div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-gray-900">Technical</div>
                    </td>
                    <td class="py-4 px-4">
                        <span class="priority-high">High</span>
                    </td>
                    <td class="py-4 px-4">
                        <span class="status-pending">Pending</span>
                    </td>
                    <td class="py-4 px-4 text-gray-900">14 Mar 2024</td>
                    <td class="py-4 px-4">
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-900" onclick="toggleDropdown('feedback-2')">
                                <span class="material-icons-round text-base">more_vert</span>
                            </button>
                            <div id="feedback-2" class="hidden absolute right-0 mt-2 w-48 dropdown-menu z-10">
                                <a href="#" class="block dropdown-item text-sm text-gray-700">Lihat Detail</a>
                                <a href="#" class="block dropdown-item text-sm text-blue-600">Assign ke IT</a>
                                <a href="#" class="block dropdown-item text-sm text-orange-600">Escalate</a>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr class="feedback-row border-b border-gray-200">
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <img alt="Linda Sari" class="w-10 h-10 rounded-full mr-3" src="https://picsum.photos/seed/linda/40/40.jpg">
                            <div>
                                <div class="text-gray-900 font-medium">Linda Sari</div>
                                <div class="text-gray-500 text-xs">Customer</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="rating-stars">
                            <span class="star material-icons-round">star</span>
                            <span class="star material-icons-round">star</span>
                            <span class="star material-icons-round">star</span>
                            <span class="star material-icons-round">star</span>
                            <span class="star empty material-icons-round">star</span>
                            <span class="text-xs text-gray-500 ml-1">(4.0)</span>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="feedback-text text-gray-900">Pelayanan baik, tapi waktu tunggu agak lama. Semoga bisa ditingkatkan lagi.</div>
                        <div class="text-gray-500 text-xs mt-1">Trip #TK2024002</div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-gray-900">Service</div>
                    </td>
                    <td class="py-4 px-4">
                        <span class="priority-medium">Medium</span>
                    </td>
                    <td class="py-4 px-4">
                        <span class="status-open">Open</span>
                    </td>
                    <td class="py-4 px-4 text-gray-900">13 Mar 2024</td>
                    <td class="py-4 px-4">
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-900" onclick="toggleDropdown('feedback-3')">
                                <span class="material-icons-round text-base">more_vert</span>
                            </button>
                            <div id="feedback-3" class="hidden absolute right-0 mt-2 w-48 dropdown-menu z-10">
                                <a href="#" class="block dropdown-item text-sm text-gray-700">Lihat Detail</a>
                                <a href="#" class="block dropdown-item text-sm text-blue-600">Balas</a>
                                <a href="#" class="block dropdown-item text-sm text-yellow-600">Follow Up</a>
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
            Menampilkan 1-10 dari 847 umpan balik
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

<!-- Quick Stats -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
    <div class="card p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Rating Distribution</h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-sm">5 ⭐</span>
                </div>
                <div class="flex-1 mx-4">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: 65%"></div>
                    </div>
                </div>
                <span class="text-sm text-gray-600">547</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-sm">4 ⭐</span>
                </div>
                <div class="flex-1 mx-4">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: 20%"></div>
                    </div>
                </div>
                <span class="text-sm text-gray-600">169</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-sm">3 ⭐</span>
                </div>
                <div class="flex-1 mx-4">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-yellow-500 h-2 rounded-full" style="width: 10%"></div>
                    </div>
                </div>
                <span class="text-sm text-gray-600">85</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-sm">2 ⭐</span>
                </div>
                <div class="flex-1 mx-4">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-orange-500 h-2 rounded-full" style="width: 3%"></div>
                    </div>
                </div>
                <span class="text-sm text-gray-600">25</span>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-sm">1 ⭐</span>
                </div>
                <div class="flex-1 mx-4">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-red-500 h-2 rounded-full" style="width: 2%"></div>
                    </div>
                </div>
                <span class="text-sm text-gray-600">21</span>
            </div>
        </div>
    </div>

    <div class="card p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Actions</h3>
        <div class="space-y-4">
            <div class="flex items-start space-x-3">
                <div class="p-2 bg-green-100 rounded-full">
                    <span class="material-icons-round text-green-600 text-sm">check_circle</span>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">Feedback from Sarah Johnson resolved</p>
                    <p class="text-xs text-gray-500">2 hours ago</p>
                </div>
            </div>
            <div class="flex items-start space-x-3">
                <div class="p-2 bg-blue-100 rounded-full">
                    <span class="material-icons-round text-blue-600 text-sm">reply</span>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">Reply sent to Ahmad Rahman</p>
                    <p class="text-xs text-gray-500">4 hours ago</p>
                </div>
            </div>
            <div class="flex items-start space-x-3">
                <div class="p-2 bg-orange-100 rounded-full">
                    <span class="material-icons-round text-orange-600 text-sm">priority_high</span>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-900">High priority ticket escalated</p>
                    <p class="text-xs text-gray-500">6 hours ago</p>
                </div>
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
