<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Detail Kendaraan - TaksiKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #6366F1;
            --primary-dark: #4F46E5;
            --secondary: #14B8A6;
            --accent: #F97316;
            --danger: #EF4444;
            --warning: #F59E0B;
            --success: #10B981;
            --dark: #0F172A;
            --gray: #64748B;
            --light: #F1F5F9;
            --sidebar-dark: #1E293B;
            --sidebar-darker: #0F172A;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f0f0ff;
            color: var(--dark);
            overflow-x: hidden;
        }

        .glass-morphism {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        }

        .sidebar {
            background: linear-gradient(180deg, var(--sidebar-dark) 0%, var(--sidebar-darker) 100%);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar.collapsed .sidebar-text {
            display: none;
        }

        .sidebar.collapsed .nav-item {
            justify-content: center;
        }

        .card {
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            transition: all 0.3s ease;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger) 0%, #DC2626 100%);
            color: white;
            transition: all 0.3s ease;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        }

        .nav-item {
            color: rgba(255, 255, 255, 0.7);
            transition: all 0.3s ease;
            border-radius: 12px;
            margin: 6px 0;
            position: relative;
            overflow: hidden;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
            transition: width 0.3s ease;
            z-index: -1;
        }

        .nav-item:hover::before {
            width: 100%;
        }

        .nav-item:hover {
            color: white;
        }

        .nav-item.active {
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
            color: white;
            font-weight: 600;
        }

        .user-avatar {
            border: 3px solid white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar-toggle {
            position: absolute;
            right: -15px;
            top: 20px;
            background: white;
            color: var(--primary);
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            z-index: 10;
        }

        .status-active {
            background: linear-gradient(135deg, #10B981, #059669);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            box-shadow: 0 2px 10px rgba(16, 185, 129, 0.3);
        }

        .status-inactive {
            background: linear-gradient(135deg, #6B7280, #4B5563);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            box-shadow: 0 2px 10px rgba(107, 114, 128, 0.3);
        }

        .vehicle-type {
            background: linear-gradient(135deg, #3B82F6, #2563EB);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            box-shadow: 0 2px 10px rgba(59, 130, 246, 0.3);
        }

        .info-item {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 15px;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            background: #f0f2f5;
            transform: translateY(-2px);
        }

        .info-label {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 16px;
            font-weight: 600;
            color: #1e293b;
        }

        .vehicle-image {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .vehicle-image:hover {
            transform: scale(1.02);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .mobile-menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 20;
            display: none;
        }

        .mobile-menu-overlay.active {
            display: block;
        }

        .tab-button {
            padding: 8px 16px;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .tab-button.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }

        .tab-button:not(.active):hover {
            background-color: rgba(99, 102, 241, 0.1);
        }

        .spec-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .spec-item:last-child {
            border-bottom: none;
        }

        .spec-label {
            flex: 1;
            font-size: 14px;
            color: #64748b;
        }

        .spec-value {
            font-weight: 600;
            color: #1e293b;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -100%;
                top: 0;
                height: 100vh;
                z-index: 30;
                transition: left 0.3s ease;
            }

            .sidebar.active {
                left: 0;
            }
        }
    </style>
</head>
<body class="flex h-screen">
<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay" id="mobile-menu-overlay"></div>

<!-- Sidebar -->
<aside class="sidebar w-64 flex-shrink-0 flex-col justify-between p-4 hidden md:flex text-white relative" id="sidebar">
    <div class="sidebar-toggle" onclick="toggleSidebar()">
        <span class="material-icons-round text-sm">chevron_left</span>
    </div>

    <div>
        <div class="flex items-center mb-10">
            <div class="p-3 rounded-xl mr-3 bg-gradient-to-r from-white to-white/20">
                <span class="material-icons-round text-white">local_taxi</span>
            </div>
            <div class="sidebar-text">
                <h1 class="font-bold text-xl">TaksiKu</h1>
                <p class="text-xs opacity-80">Dashboard v4.0</p>
            </div>
        </div>

        <nav class="space-y-1">
            <a class="flex items-center p-3 rounded-lg nav-item" href="#">
                <span class="material-icons-round mr-4">dashboard</span>
                <span class="sidebar-text">Dashboard</span>
            </a>
            <a class="flex items-center p-3 rounded-lg nav-item" href="#">
                <span class="material-icons-round mr-4">receipt_long</span>
                <span class="sidebar-text">Pesanan</span>
            </a>
            <a class="flex items-center p-3 rounded-lg nav-item" href="#">
                <span class="material-icons-round mr-4">groups</span>
                <span class="sidebar-text">Pengguna</span>
            </a>
            <a class="flex items-center p-3 rounded-lg nav-item" href="#">
                <span class="material-icons-round mr-4">feedback</span>
                <span class="sidebar-text">Umpan Balik</span>
            </a>
            <a class="flex items-center p-3 rounded-lg nav-item active" href="#">
                <span class="material-icons-round mr-4">directions_car</span>
                <span class="sidebar-text">Kendaraan</span>
            </a>
            <a class="flex items-center p-3 rounded-lg nav-item" href="#">
                <span class="material-icons-round mr-4">account_balance_wallet</span>
                <span class="sidebar-text">Saldo</span>
            </a>
            <a class="flex items-center p-3 rounded-lg nav-item" href="#">
                <span class="material-icons-round mr-4">person_add</span>
                <span class="sidebar-text">Pendaftaran Driver</span>
            </a>
            <a class="flex items-center p-3 rounded-lg nav-item" href="#">
                <span class="material-icons-round mr-4">settings</span>
                <span class="sidebar-text">Pengaturan Harga</span>
            </a>
        </nav>
    </div>

    <div class="border-t border-white border-opacity-20 pt-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <img src="https://picsum.photos/seed/admin/40/40.jpg" alt="Admin" class="w-10 h-10 rounded-full mr-3 user-avatar">
                <div class="sidebar-text">
                    <p class="font-semibold">Admin Sistem</p>
                    <p class="text-xs opacity-80">Administrator</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <button class="text-white opacity-70 hover:opacity-100">
                    <span class="material-icons-round">logout</span>
                </button>
            </div>
        </div>
    </div>
</aside>

<!-- Main Content -->
<main class="flex-1 flex flex-col overflow-hidden">
    <!-- Top Header -->
    <header class="glass-morphism p-4 flex justify-between items-center m-4">
        <div class="flex items-center">
            <button class="md:hidden mr-4 text-gray-600" onclick="toggleMobileSidebar()">
                <span class="material-icons-round">menu</span>
            </button>
            <div>
                <h2 class="text-2xl font-bold text-white">Detail Kendaraan</h2>
                <p class="text-white/80 text-sm">Informasi lengkap tentang kendaraan</p>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            <button class="btn-primary px-6 py-2 font-medium flex items-center">
                <span class="material-icons-round text-sm mr-2">edit</span>
                Edit Kendaraan
            </button>
            <button class="btn-danger px-6 py-2 font-medium flex items-center">
                <span class="material-icons-round text-sm mr-2">delete</span>
                Hapus Kendaraan
            </button>
        </div>
    </header>

    <!-- Page Content -->
    <div class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Vehicle Header -->
        <div class="card p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="flex items-center mb-4 md:mb-0">
                    <img src="https://picsum.photos/seed/honda-beat/200/150.jpg" alt="Honda Beat" class="vehicle-image w-32 h-24 md:w-40 md:h-30 object-cover mr-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Honda Beat 2020</h3>
                        <p class="text-gray-500">B1234ABCA123</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3 mt-4 md:mt-0">
                    <span class="vehicle-type">MOTORCYCLE</span>
                    <span class="status-inactive">TIDAK AKTIF</span>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="card p-6 mb-6">
            <div class="flex space-x-1 border-b border-gray-200 mb-6">
                <button class="tab-button active" onclick="showTab('basic')">Informasi Dasar</button>
                <button class="tab-button" onclick="showTab('details')">Detail Kendaraan</button>
                <button class="tab-button" onclick="showTab('specs')">Spesifikasi</button>
                <button class="tab-button" onclick="showTab('documents')">Dokumen</button>
            </div>

            <!-- Basic Information Tab -->
            <div id="basic-tab" class="tab-content">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="info-item">
                            <p class="info-label">Nomor Plat</p>
                            <p class="info-value">B1234ABCA123</p>
                        </div>
                        <div class="info-item">
                            <p class="info-label">Tipe Kendaraan</p>
                            <p class="info-value">MOTORCYCLE</p>
                        </div>
                        <div class="info-item">
                            <p class="info-label">Merek</p>
                            <p class="info-value">Honda</p>
                        </div>
                        <div class="info-item">
                            <p class="info-label">Model</p>
                            <p class="info-value">Beat</p>
                        </div>
                        <div class="info-item">
                            <p class="info-label">Tahun</p>
                            <p class="info-value">2020</p>
                        </div>
                        <div class="info-item">
                            <p class="info-label">Warna</p>
                            <p class="info-value">Hitam</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="info-item">
                            <p class="info-label">Status</p>
                            <span class="status-inactive">TIDAK AKTIF</span>
                        </div>
                        <div class="info-item">
                            <p class="info-label">ID Kendaraan</p>
                            <p class="info-value font-mono text-sm">274ebd20-cba8-47ec-9065-ee029acbd4c1</p>
                        </div>
                        <div class="info-item">
                            <p class="info-label">ID Driver</p>
                            <p class="info-value font-mono text-sm">559d956e-36a8-494d-9a10-cb003f627d67</p>
                        </div>
                        <div class="info-item">
                            <p class="info-label">Tanggal Dibuat</p>
                            <p class="info-value">1 Sep 2025</p>
                            <p class="text-xs text-gray-500">15:28</p>
                        </div>
                        <div class="info-item">
                            <p class="info-label">Terakhir Diperbarui</p>
                            <p class="info-value">1 Sep 2025</p>
                            <p class="text-xs text-gray-500">15:28</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vehicle Details Tab -->
            <div id="details-tab" class="tab-content hidden">
                <div class="space-y-4">
                    <div class="info-item">
                        <p class="info-label">Nomor Mesin</p>
                        <p class="info-value">JM61KMF5E4K123456</p>
                    </div>
                    <div class="info-item">
                        <p class="info-label">Nomor Rangka</p>
                        <p class="info-value">MH1JM6103KJK123456</p>
                    </div>
                    <div class="info-item">
                        <p class="info-label">Nomor STNK</p>
                        <p class="info-value">1234567890</p>
                    </div>
                    <div class="info-item">
                        <p class="info-label">Masa Kadaluarsa STNK</p>
                        <p class="info-value">5 tahun</p>
                    </div>
                    <div class="info-item">
                        <p class="info-label">Tanggal Pajak</p>
                        <p class="info-value">15 Januari 2025</p>
                    </div>
                </div>
            </div>

            <!-- Specifications Tab -->
            <div id="specs-tab" class="tab-content hidden">
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Spesifikasi Mesin</h4>
                    <div class="spec-item">
                        <span class="spec-label">Tipe Mesin</span>
                        <span class="spec-value">4-langkah, SOHC, eSP</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Kapasitas Mesin</span>
                        <span class="spec-value">109.7 cc</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Daya Maksimum</span>
                        <span class="spec-value">6.6 kW (9 PS) @ 7500 rpm</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Torsi Maksimum</span>
                        <span class="spec-value">9.3 Nm @ 5500 rpm</span>
                    </div>

                    <h4 class="text-lg font-semibold text-gray-800 mb-4 mt-6">Dimensi & Berat</h4>
                    <div class="spec-item">
                        <span class="spec-label">Panjang x Lebar x Tinggi</span>
                        <span class="spec-value">1.926 x 0.742 x 1.076 m</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Jarak Sumbu Roda</span>
                        <span class="spec-value">1.276 m</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Tinggi Jok</span>
                        <span class="spec-value">0.78 m</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Berat Kosong</span>
                        <span class="spec-value">112 kg</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Kapasitas Bahan Bakar</span>
                        <span class="spec-value">6 L</span>
                    </div>
                </div>
            </div>

            <!-- Documents Tab -->
            <div id="documents-tab" class="tab-content hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Dokumen Kendaraan</h4>
                        <div class="space-y-4">
                            <div class="info-item">
                                <p class="info-label">STNK</p>
                                <a href="#" class="text-blue-600 hover:underline flex items-center">
                                    <span class="material-icons-round text-sm mr-2">description</span>
                                    Lihat Dokumen
                                </a>
                            </div>
                            <div class="info-item">
                                <p class="info-label">BPKB</p>
                                <a href="#" class="text-blue-600 hover:underline flex items-center">
                                    <span class="material-icons-round text-sm mr-2">description</span>
                                    Lihat Dokumen
                                </a>
                            </div>
                            <div class="info-item">
                                <p class="info-label">Asuransi</p>
                                <a href="#" class="text-blue-600 hover:underline flex items-center">
                                    <span class="material-icons-round text-sm mr-2">description</span>
                                    Lihat Dokumen
                                </a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Dokumen Driver</h4>
                        <div class="space-y-4">
                            <div class="info-item">
                                <p class="info-label">SIM</p>
                                <a href="#" class="text-blue-600 hover:underline flex items-center">
                                    <span class="material-icons-round text-sm mr-2">description</span>
                                    Lihat Dokumen
                                </a>
                            </div>
                            <div class="info-item">
                                <p class="info-label">Surat Izin Mengemudi</p>
                                <a href="#" class="text-blue-600 hover:underline flex items-center">
                                    <span class="material-icons-round text-sm mr-2">description</span>
                                    Lihat Dokumen
                                </a>
                            </div>
                            <div class="info-item">
                                <p class="info-label">Sertifikat Keahlian</p>
                                <a href="#" class="text-blue-600 hover:underline flex items-center">
                                    <span class="material-icons-round text-sm mr-2">description</span>
                                    Lihat Dokumen
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Driver Information -->
        <div class="card p-6">
            <h3 class="text-xl font-semibold mb-4 text-gray-800">Informasi Driver</h3>
            <div class="flex items-center mb-4">
                <img src="https://picsum.photos/seed/driver/60/60.jpg" alt="Driver" class="w-16 h-16 rounded-full mr-4">
                <div class="absolute bottom-0 right-0 w-5 h-5 bg-green-500 rounded-full flex items-center justify-center">
                    <span class="material-icons-round text-white text-xs">check</span>
                </div>
            </div>
                <div>
                    <p class="font-medium text-gray-900">Budi Santoso</p>
                    <p class="text-sm text-gray-500">Driver</p>
                    <div class="flex items-center mt-1">
                        <div class="flex text-yellow-400">
                            <span class="material-icons-round" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-icons-round" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-icons-round" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-icons-round" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-icons-round">star</span>
                        </div>
                        <span class="text-sm text-gray-500 ml-1">4.8</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="info-item">
                    <p class="info-label">Nomor Telepon</p>
                    <p class="info-value">+628123456789</p>
                </div>
                <div class="info-item">
                    <p class="info-label">Email</p>
                    <p class="info-value">budi@example.com</p>
                </div>
                <div class="info-item">
                    <p class="info-label">Alamat</p>
                    <p class="info-value">Jl. Sudirman No. 123, Jakarta Pusat</p>
                </div>
                <div class="info-item">
                    <p class="info-label">Tanggal Bergabung</p>
                    <p class="info-value">15 Januari 2023</p>
                </div>
                <div class="info-item">
                    <p class="info-label">Total Perjalanan</p>
                    <p class="info-value">156</p>
                </div>
                <div class="info-item">
                    <p class="info-label">Total Pendapatan</p>
                    <p class="info-value">Rp 15.600.000</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="glass-morphism p-4 flex justify-between items-center text-sm text-white m-4">
        <p>© 2024 TaksiKu. Semua hak dilindungi.</p>
        <div class="flex items-center space-x-6">
            <div class="flex items-center space-x-2">
                <span class="material-icons-round text-base">speed</span>
                <span>127 ms</span>
                <span class="material-icons-round text-base">wifi_tethering</span>
            </div>
            <div class="flex items-center space-x-4">
                <span>v4.0.0</span>
                <a class="hover:text-white/80" href="#">Bantuan</a>
                <a class="hover:text-white/80" href="#">Dokumentasi</a>
            </div>
        </div>
    </footer>
</main>

<!-- Mobile Sidebar -->
<div id="mobile-sidebar" class="md:hidden fixed inset-0 z-20 hidden">
    <div class="mobile-menu-overlay" onclick="toggleMobileSidebar()"></div>
    <div class="sidebar w-64 h-full p-4 text-white relative">
        <div class="flex justify-between items-center mb-10">
            <div class="flex items-center">
                <div class="p-2 rounded-lg mr-3 bg-white bg-opacity-20">
                    <span class="material-icons-round text-white">local_taxi</span>
                </div>
                <div>
                    <h1 class="font-bold text-lg">TaksiKu</h1>
                    <p class="text-xs opacity-80">Dashboard v4.0</p>
                </div>
            </div>
            <button class="text-white" onclick="toggleMobileSidebar()">
                <span class="material-icons-round">close</span>
            </button>
        </div>

        <nav class="space-y-1">
            <a class="flex items-center p-3 rounded-lg nav-item" href="#">
                <span class="material-icons-round mr-4">dashboard</span>
                Dashboard
            </a>
            <a class="flex items-center p-3 rounded-lg nav-item" href="#">
                <span class="material-icons-round mr-4">receipt_long</span>
                Pesanan
            </a>
            <a class="flex items-center p-3 rounded-lg nav-item" href="#">
                <span class="material-icons-round mr-4">groups</span>
                Pengguna
            </a>
            <a class="flex items-center p-3 rounded-lg nav-item" href="#">
                <span class="material-icons-round mr-4">feedback</span>
                Umpan Balik
            </a>
            <a class="flex items-center p-3 rounded-lg nav-item active" href="#">
                <span class="material-icons-round mr-4">directions_car</span>
                Kendaraan
            </a>
            <a class="flex items-center p-3 rounded-lg nav-item" href="#">
                <span class="material-icons-round mr-4">account_balance_wallet</span>
                Saldo
            </a>
            <a class="flex items-center p-3 rounded-lg nav-item" href="#">
                <span class="material-icons-round mr-4">person_add</span>
                Pendaftaran Driver
            </a>
            <a class="flex items-center p-3 rounded-lg nav-item" href="#">
                <span class="material-icons-round mr-4">settings</span>
                Pengaturan Harga
            </a>
        </nav>

        <div class="border-t border-white border-opacity-20 pt-4 mt-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <img src="https://picsum.photos/seed/admin2/40/40.jpg" alt="Admin" class="w-10 h-10 rounded-full mr-3">
                        <div>
                            <p class="font-semibold">Admin Sistem</p>
                            <p class="text-xs opacity-80">Administrator</p>
                        </div>
                    </div>
                    <button class="text-white opacity-70 hover:opacity-100">
                        <span class="material-icons-round">logout</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle mobile sidebar
    function toggleMobileSidebar() {
        const sidebar = document.getElementById('mobile-sidebar');
        const overlay = document.getElementById('mobile-menu-overlay');

        sidebar.classList.toggle('hidden');
        overlay.classList.toggle('active');
    }

    // Toggle sidebar collapse
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = sidebar.querySelector('.sidebar-toggle span');

        sidebar.classList.toggle('collapsed');

        if (sidebar.classList.contains('collapsed')) {
            toggleBtn.textContent = 'chevron_right';
        } else {
            toggleBtn.textContent = 'chevron_left';
        }
    }

    // Tab functionality
    function showTab(tabName) {
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('hidden');
        });

        // Remove active class from all tab buttons
        document.querySelectorAll('.tab-button').forEach(button => {
            button.classList.remove('active');
        });

        // Show selected tab
        document.getElementById(tabName + '-tab').classList.remove('hidden');

        // Add active class to clicked button
        event.target.classList.add('active');
    }
</script>
</body>
</html>
