@extends('layouts.app')

@section('title', 'Registrasi Driver - TaksiKu')
@section('header', 'Registrasi Driver')
@section('subheader', 'Kelola aplikasi dan verifikasi driver baru')
@section('action-button', 'Verifikasi Manual')

@push('styles')
<style>
    .stat-card {
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .status-pending {
        background: linear-gradient(135deg, #F59E0B, #F97316);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .status-approved {
        background: linear-gradient(135deg, #10B981, #14B8A6);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .status-rejected {
        background: linear-gradient(135deg, #EF4444, #DC2626);
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
    <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #F59E0B 0%, #F97316 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Menunggu Verifikasi</p>
                <p class="text-3xl font-bold mt-2">23</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">pending</span>
                    <span class="text-xs ml-1">Perlu ditinjau</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">pending</span>
            </div>
        </div>
    </div>

    <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #10B981 0%, #14B8A6 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Disetujui</p>
                <p class="text-3xl font-bold mt-2">156</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">check_circle</span>
                    <span class="text-xs ml-1">Driver aktif</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">check_circle</span>
            </div>
        </div>
    </div>

    <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Ditolak</p>
                <p class="text-3xl font-bold mt-2">8</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">cancel</span>
                    <span class="text-xs ml-1">Tidak memenuhi syarat</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">cancel</span>
            </div>
        </div>
    </div>

    <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Total Aplikasi</p>
                <p class="text-3xl font-bold mt-2">187</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">person_add</span>
                    <span class="text-xs ml-1">Bulan ini</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">person_add</span>
            </div>
        </div>
    </div>
</div>

<!-- Driver Applications Table -->
<div class="card p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-800">Aplikasi Driver Terbaru</h3>
        <div class="flex items-center space-x-4">
            <div class="flex space-x-2">
                <button class="filter-btn active">Semua</button>
                <button class="filter-btn">Pending</button>
                <button class="filter-btn">Approved</button>
                <button class="filter-btn">Rejected</button>
            </div>
            <button class="btn-primary px-4 py-2 font-medium flex items-center">
                <span class="material-icons-round text-sm mr-1">verified_user</span>
                Verifikasi Batch
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
                    <th class="py-3 px-4" scope="col">Calon Driver</th>
                    <th class="py-3 px-4" scope="col">Kendaraan</th>
                    <th class="py-3 px-4" scope="col">Dokumen</th>
                    <th class="py-3 px-4" scope="col">Status</th>
                    <th class="py-3 px-4" scope="col">Tanggal Daftar</th>
                    <th class="py-3 px-4" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-4 px-4">
                        <input type="checkbox" class="rounded">
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <img alt="Budi Hartono" class="w-10 h-10 rounded-full mr-3" src="https://picsum.photos/seed/budi4/40/40.jpg">
                            <div>
                                <div class="text-gray-900 font-medium">Budi Hartono</div>
                                <div class="text-gray-500 text-xs">+62 812-9876-5432</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-gray-900 font-medium">Toyota Avanza</div>
                        <div class="text-gray-500 text-xs">B 9876 DEF (2018)</div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex space-x-1">
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">KTP ✓</span>
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">SIM ✓</span>
                            <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">STNK ⏳</span>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <span class="status-pending">Menunggu</span>
                    </td>
                    <td class="py-4 px-4 text-gray-900">15 Mar 2024</td>
                    <td class="py-4 px-4">
                        <div class="flex space-x-2">
                            <button class="text-green-600 hover:text-green-800">
                                <span class="material-icons-round text-sm">check</span>
                            </button>
                            <button class="text-blue-600 hover:text-blue-800">
                                <span class="material-icons-round text-sm">visibility</span>
                            </button>
                            <button class="text-red-600 hover:text-red-800">
                                <span class="material-icons-round text-sm">close</span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between items-center mt-6">
        <div class="text-sm text-gray-500">
            Menampilkan 1-10 dari 23 aplikasi
        </div>
        <div class="flex space-x-2">
            <button class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50">Sebelumnya</button>
            <button class="px-3 py-1 text-sm bg-blue-600 text-white rounded">1</button>
            <button class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50">2</button>
            <button class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50">Selanjutnya</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Filter buttons
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>
@endpush
