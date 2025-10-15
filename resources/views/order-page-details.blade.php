<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Detail Pesanan - TaksiKu</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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

        .status-completed {
            background: linear-gradient(135deg, #10B981, #059669);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            box-shadow: 0 2px 10px rgba(16, 185, 129, 0.3);
        }

        .timeline-item {
            position: relative;
            padding-left: 30px;
            margin-bottom: 20px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: 8px;
            top: 8px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            box-shadow: 0 0 10px rgba(99, 102, 241, 0.5);
        }

        .timeline-item::after {
            content: '';
            position: absolute;
            left: 13px;
            top: 20px;
            width: 2px;
            height: calc(100% - 8px);
            background: linear-gradient(to bottom, var(--primary), transparent);
        }

        .timeline-item:last-child::after {
            display: none;
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

        .rating-stars {
            color: #fbbf24;
        }

        .map-link {
            color: var(--primary);
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s ease;
        }

        .map-link:hover {
            transform: translateY(-2px);
            text-decoration: underline;
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
            <a class="flex items-center p-3 rounded-lg nav-item active" href="#">
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
            <a class="flex items-center p-3 rounded-lg nav-item" href="#">
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
                <h2 class="text-2xl font-bold text-white">Detail Pesanan</h2>
                <p class="text-white/80 text-sm">Informasi lengkap tentang pesanan taksi</p>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            <button class="btn-primary px-6 py-2 font-medium flex items-center">
                <span class="material-icons-round text-sm mr-2">print</span>
                Cetak
            </button>
            <button class="bg-white/20 hover:bg-white/30 text-white font-medium py-2 px-4 rounded-lg transition flex items-center">
                <span class="material-icons-round text-sm mr-2">download</span>
                Unduh
            </button>
        </div>
    </header>

    <!-- Page Content -->
    <div class="flex-1 overflow-y-auto p-4 md:p-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Order Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Order Information Card -->
                <div class="card p-6">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">Informasi Pesanan</h3>
                            <p class="text-sm text-gray-500 mt-1">ID Pesanan: #652f0e6e</p>
                        </div>
                        <span class="status-completed">SELESAI</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                        <div class="info-item">
                            <p class="info-label">Tipe Kendaraan</p>
                            <p class="info-value">MOTORCYCLE</p>
                        </div>
                        <div class="info-item">
                            <p class="info-label">Jumlah Tarif</p>
                            <p class="info-value">Rp 720.000</p>
                        </div>
                        <div class="info-item">
                            <p class="info-label">Jarak</p>
                            <p class="info-value">5 km</p>
                        </div>
                        <div class="info-item">
                            <p class="info-label">Durasi Perjalanan</p>
                            <p class="info-value">15 menit</p>
                        </div>
                        <div class="info-item">
                            <p class="info-label">Biaya Driver</p>
                            <p class="info-value">Rp 648.000</p>
                        </div>
                        <div class="info-item">
                            <p class="info-label">Metode Pembayaran</p>
                            <div class="flex items-center">
                                <span class="material-icons-round text-green-600 mr-2">payments</span>
                                <p class="info-value">TUNAI</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <p class="info-label">Biaya Admin</p>
                            <p class="info-value">Rp 72.000</p>
                        </div>
                    </div>
                </div>

                <!-- Route Information Card -->
                <div class="card p-6">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Informasi Rute</h3>

                    <div class="mb-6">
                        <p class="info-label mb-2">Lokasi Penjemputan</p>
                        <p class="info-value mb-2">Jl. Sudirman No. 1, Jakarta Pusat</p>
                        <a class="map-link" href="#">
                            <span class="material-icons-round text-sm mr-1">map</span>
                            Lihat di Peta
                        </a>
                    </div>

                    <div>
                        <p class="info-label mb-2">Tujuan</p>
                        <p class="info-value mb-2">Plaza Indonesia, Jakarta Pusat</p>
                        <a class="map-link" href="#">
                            <span class="material-icons-round text-sm mr-1">map</span>
                            Lihat di Peta
                        </a>
                    </div>
                </div>

                <!-- Order Timeline Card -->
                <div class="card p-6">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Timeline Pesanan</h3>

                    <div class="space-y-6">
                        <div class="timeline-item">
                            <div class="flex justify-between">
                                <p class="font-medium text-gray-900">Pesanan Dibuat</p>
                                <p class="text-sm text-gray-500">1 Sep 2025, 16:02</p>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">Pelanggan membuat pesanan</p>
                        </div>

                        <div class="timeline-item">
                            <div class="flex justify-between">
                                <p class="font-medium text-gray-900">Driver Menerima</p>
                                <p class="text-sm text-gray-500">1 Sep 2025, 16:03</p>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">Driver menerima permintaan perjalanan</p>
                        </div>

                        <div class="timeline-item">
                            <div class="flex justify-between">
                                <p class="font-medium text-gray-900">Driver Tiba</p>
                                <p class="text-sm text-gray-500">1 Sep 2025, 16:04</p>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">Driver tiba di lokasi penjemputan</p>
                        </div>

                        <div class="timeline-item">
                            <div class="flex justify-between">
                                <p class="font-medium text-gray-900">Perjalanan Dimulai</p>
                                <p class="text-sm text-gray-500">1 Sep 2025, 16:07</p>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">Perjalanan sedang berlangsung</p>
                        </div>

                        <div class="timeline-item">
                            <div class="flex justify-between">
                                <p class="font-medium text-gray-900">Perjalanan Selesai</p>
                                <p class="text-sm text-gray-500">1 Sep 2025, 16:57</p>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">Perjalanan selesai dengan sukses</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Customer & Driver Info -->
            <div class="space-y-6">
                <!-- Customer Information Card -->
                <div class="card p-6">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Informasi Pelanggan</h3>

                    <div class="flex items-center mb-4">
                        <img src="https://picsum.photos/seed/customer/60/60.jpg" alt="Customer" class="w-14 h-14 rounded-full mr-4">
                        <div>
                            <p class="font-medium text-gray-900">customer</p>
                            <p class="text-sm text-gray-500">Pelanggan</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center">
                            <span class="material-icons-round text-gray-500 mr-3">call</span>
                            <p class="text-gray-800">+628123456789</p>
                        </div>
                        <div class="flex items-center">
                            <span class="material-icons-round text-gray-500 mr-3">email</span>
                            <p class="text-gray-800">customer@example.com</p>
                        </div>
                        <div class="flex items-center">
                            <span class="material-icons-round text-gray-500 mr-3">location_on</span>
                            <p class="text-gray-800">Jakarta Pusat</p>
                        </div>
                    </div>
                </div>

                <!-- Driver Information Card -->
                <div class="card p-6">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Informasi Driver</h3>

                    <div class="flex items-center mb-4">
                        <img src="https://picsum.photos/seed/driver/60/60.jpg" alt="Driver" class="w-14 h-14 rounded-full mr-4">
                        <div>
                            <p class="font-medium text-gray-900">test</p>
                            <p class="text-sm text-gray-500">Driver</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center">
                            <span class="material-icons-round text-gray-500 mr-3">call</span>
                            <p class="text-gray-800">+628123456789</p>
                        </div>
                        <div class="flex items-center">
                            <span class="material-icons-round text-gray-500 mr-3">directions_car</span>
                            <p class="text-gray-800">Honda Beat 2020</p>
                        </div>
                        <div class="flex items-center">
                            <span class="material-icons-round text-gray-500 mr-3">badge</span>
                            <p class="text-gray-800">B 1234 ABC</p>
                        </div>
                        <div class="flex items-center">
                            <div class="rating-stars mr-3">
                                <span class="material-icons-round" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-icons-round" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-icons-round" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-icons-round" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-icons-round">star_half</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">4.8</p>
                                <p class="text-sm text-gray-500">Rating Driver</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="card p-6">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Tindakan</h3>

                    <div class="space-y-3">
                        <button class="w-full btn-primary py-3 font-medium flex items-center justify-center">
                            <span class="material-icons-round text-sm mr-2">message</span>
                            Kirim Pesan ke Pelanggan
                        </button>
                        <button class="w-full btn-primary py-3 font-medium flex items-center justify-center">
                            <span class="material-icons-round text-sm mr-2">message</span>
                            Kirim Pesan ke Driver
                        </button>
                        <button class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-3 rounded-lg transition flex items-center justify-center">
                            <span class="material-icons-round text-sm mr-2">receipt_long</span>
                            Unduh Invoice
                        </button>
                    </div>
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
                <span>31 ms</span>
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
            <a class="flex items-center p-3 rounded-lg nav-item active" href="#">
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
            <a class="flex items-center p-3 rounded-lg nav-item" href="#">
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
</script>
</body>
</html>
