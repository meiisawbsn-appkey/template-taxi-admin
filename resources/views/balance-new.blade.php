@extends('layouts.app')

@section('title', 'Manajemen Saldo - TaksiKu')
@section('header', 'Manajemen Saldo')
@section('subheader', 'Kelola permintaan saldo driver dan penarikan dana')
@section('action-button', 'Permintaan Baru')

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

    .balance-row {
        transition: all 0.2s ease;
    }

    .balance-row:hover {
        background-color: rgba(99, 102, 241, 0.05);
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

    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 30;
        display: none;
        align-items: center;
        justify-content: center;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-content {
        background: white;
        border-radius: 20px;
        width: 90%;
        max-width: 720px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: modalSlideIn 0.3s ease;
    }

    @keyframes modalSlideIn {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
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
                <p class="text-sm opacity-80">Menunggu</p>
                <p class="text-3xl font-bold mt-2">0</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">hourglass_empty</span>
                    <span class="text-xs ml-1">Permintaan menunggu persetujuan</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">hourglass_empty</span>
            </div>
        </div>
    </div>

    <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #10B981 0%, #14B8A6 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Disetujui</p>
                <p class="text-3xl font-bold mt-2">1</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">check_circle</span>
                    <span class="text-xs ml-1">Permintaan disetujui</span>
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
                <p class="text-3xl font-bold mt-2">2</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">cancel</span>
                    <span class="text-xs ml-1">Permintaan ditolak</span>
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
                <p class="text-sm opacity-80">Total Dana</p>
                <p class="text-3xl font-bold mt-2">Rp 2.5M</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">account_balance_wallet</span>
                    <span class="text-xs ml-1">Total dana yang dikelola</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">account_balance_wallet</span>
            </div>
        </div>
    </div>
</div>

<!-- Balance Requests Table -->
<div class="card p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-800">Permintaan Saldo</h3>
        <div class="flex items-center space-x-4">
            <div class="flex space-x-2">
                <button class="filter-btn active">Semua</button>
                <button class="filter-btn">Menunggu</button>
                <button class="filter-btn">Disetujui</button>
                <button class="filter-btn">Ditolak</button>
            </div>
            <button class="btn-primary px-4 py-2 font-medium flex items-center" onclick="openRequestModal()">
                <span class="material-icons-round text-sm mr-1">add</span>
                Permintaan Baru
            </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-800">
            <thead class="border-b border-gray-200 text-xs uppercase text-gray-500">
                <tr>
                    <th class="py-3 px-4" scope="col">Driver</th>
                    <th class="py-3 px-4" scope="col">Jumlah</th>
                    <th class="py-3 px-4" scope="col">Metode</th>
                    <th class="py-3 px-4" scope="col">Status</th>
                    <th class="py-3 px-4" scope="col">Tanggal</th>
                    <th class="py-3 px-4" scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="balance-row border-b border-gray-200">
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <img alt="Ahmad Rifai" class="w-10 h-10 rounded-full mr-3" src="https://picsum.photos/seed/ahmad/40/40.jpg">
                            <div>
                                <div class="text-gray-900 font-medium">Ahmad Rifai</div>
                                <div class="text-gray-500 text-xs">ID: DRV001</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-gray-900 font-medium">Rp 500,000</div>
                        <div class="text-gray-500 text-xs">Top-up Saldo</div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-gray-900">Transfer Bank</div>
                        <div class="text-gray-500 text-xs">BCA - 1234567890</div>
                    </td>
                    <td class="py-4 px-4">
                        <span class="status-pending">Menunggu</span>
                    </td>
                    <td class="py-4 px-4 text-gray-900">15 Mar 2024</td>
                    <td class="py-4 px-4">
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-900" onclick="toggleDropdown('request-1')">
                                <span class="material-icons-round text-base">more_vert</span>
                            </button>
                            <div id="request-1" class="hidden absolute right-0 mt-2 w-48 dropdown-menu z-10">
                                <a href="#" class="block dropdown-item text-sm text-green-600">Setujui</a>
                                <a href="#" class="block dropdown-item text-sm text-gray-700">Lihat Detail</a>
                                <a href="#" class="block dropdown-item text-sm text-red-600">Tolak</a>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr class="balance-row border-b border-gray-200">
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <img alt="Sari Dewi" class="w-10 h-10 rounded-full mr-3" src="https://picsum.photos/seed/sari/40/40.jpg">
                            <div>
                                <div class="text-gray-900 font-medium">Sari Dewi</div>
                                <div class="text-gray-500 text-xs">ID: DRV002</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-gray-900 font-medium">Rp 300,000</div>
                        <div class="text-gray-500 text-xs">Penarikan Dana</div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-gray-900">Transfer Bank</div>
                        <div class="text-gray-500 text-xs">Mandiri - 9876543210</div>
                    </td>
                    <td class="py-4 px-4">
                        <span class="status-approved">Disetujui</span>
                    </td>
                    <td class="py-4 px-4 text-gray-900">14 Mar 2024</td>
                    <td class="py-4 px-4">
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-900" onclick="toggleDropdown('request-2')">
                                <span class="material-icons-round text-base">more_vert</span>
                            </button>
                            <div id="request-2" class="hidden absolute right-0 mt-2 w-48 dropdown-menu z-10">
                                <a href="#" class="block dropdown-item text-sm text-gray-700">Lihat Detail</a>
                                <a href="#" class="block dropdown-item text-sm text-blue-600">Unduh Bukti</a>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr class="balance-row border-b border-gray-200">
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <img alt="Budi Santoso" class="w-10 h-10 rounded-full mr-3" src="https://picsum.photos/seed/budi/40/40.jpg">
                            <div>
                                <div class="text-gray-900 font-medium">Budi Santoso</div>
                                <div class="text-gray-500 text-xs">ID: DRV003</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-gray-900 font-medium">Rp 150,000</div>
                        <div class="text-gray-500 text-xs">Top-up Saldo</div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-gray-900">E-Wallet</div>
                        <div class="text-gray-500 text-xs">OVO - 081234567890</div>
                    </td>
                    <td class="py-4 px-4">
                        <span class="status-rejected">Ditolak</span>
                    </td>
                    <td class="py-4 px-4 text-gray-900">13 Mar 2024</td>
                    <td class="py-4 px-4">
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-900" onclick="toggleDropdown('request-3')">
                                <span class="material-icons-round text-base">more_vert</span>
                            </button>
                            <div id="request-3" class="hidden absolute right-0 mt-2 w-48 dropdown-menu z-10">
                                <a href="#" class="block dropdown-item text-sm text-gray-700">Lihat Detail</a>
                                <a href="#" class="block dropdown-item text-sm text-blue-600">Lihat Alasan</a>
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
            Menampilkan 1-10 dari 25 permintaan
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

<!-- Request Modal -->
<div id="requestModal" class="modal-overlay">
    <div class="modal-content">
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">Permintaan Saldo Baru</h3>
                <button onclick="closeRequestModal()" class="text-gray-400 hover:text-gray-600">
                    <span class="material-icons-round">close</span>
                </button>
            </div>
        </div>
        <div class="p-6">
            <form>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Driver</label>
                        <select class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option>Pilih Driver</option>
                            <option>Ahmad Rifai (DRV001)</option>
                            <option>Sari Dewi (DRV002)</option>
                            <option>Budi Santoso (DRV003)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Transaksi</label>
                        <select class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option>Top-up Saldo</option>
                            <option>Penarikan Dana</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah</label>
                        <input type="number" placeholder="Masukkan jumlah" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
                        <select class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option>Transfer Bank</option>
                            <option>E-Wallet</option>
                            <option>Cash</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                        <textarea rows="3" placeholder="Tambahkan catatan..." class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>
                </div>
                <div class="flex justify-end space-x-4 mt-6">
                    <button type="button" onclick="closeRequestModal()" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="btn-primary px-6 py-2 font-medium">
                        Buat Permintaan
                    </button>
                </div>
            </form>
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

    // Modal functions
    function openRequestModal() {
        document.getElementById('requestModal').classList.add('active');
    }

    function closeRequestModal() {
        document.getElementById('requestModal').classList.remove('active');
    }

    // Close modal when clicking overlay
    document.getElementById('requestModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeRequestModal();
        }
    });
</script>
@endpush
