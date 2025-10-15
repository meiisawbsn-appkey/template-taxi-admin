<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Dashboard TaksiKu')</title>
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
            --card-blue: #3B82F6;
            --card-purple: #8B5CF6;
            --card-teal: #14B8A6;
            --card-orange: #F97316;
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

        .stat-card {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            bottom: -20px;
            right: -20px;
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: linear-gradient(135deg, var(--danger), #DC2626);
            color: white;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: bold;
            animation: pulse 2s infinite;
            box-shadow: 0 0 10px rgba(239, 68, 68, 0.5);
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(239, 68, 68, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
            }
        }

        .status-online {
            color: var(--success);
        }

        .status-offline {
            color: var(--gray);
        }

        .dot {
            height: 12px;
            width: 12px;
            border-radius: 50%;
            display: inline-block;
        }

        .dot-online {
            background-color: var(--success);
            animation: blink 2s infinite;
        }

        .dot-offline {
            background-color: var(--gray);
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .status-completed {
            background-color: rgba(16, 185, 129, 0.15);
            color: var(--success);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-cancelled {
            background-color: rgba(239, 68, 68, 0.15);
            color: var(--danger);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-pending {
            background-color: rgba(245, 158, 11, 0.15);
            color: var(--warning);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        .activity-item {
            position: relative;
            padding-left: 30px;
            margin-bottom: 20px;
        }

        .activity-item::before {
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

        .activity-item::after {
            content: '';
            position: absolute;
            left: 13px;
            top: 20px;
            width: 2px;
            height: calc(100% - 8px);
            background: linear-gradient(to bottom, var(--primary), transparent);
        }

        .activity-item:last-child::after {
            display: none;
        }

        .progress-bar {
            height: 10px;
            background-color: #E5E7EB;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 10px;
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
        }

        .floating-action {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 10;
        }

        .dark-mode {
            background-color: #0F172A;
            color: #F1F5F9;
        }

        .dark-mode .card {
            background-color: #1E293B;
            color: #F1F5F9;
        }

        .dark-mode .sidebar {
            background: linear-gradient(180deg, #0F172A 0%, #020617 100%);
        }

        .gradient-text {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
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

        .shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: 200% 0;
            }
            100% {
                background-position: -200% 0;
            }
        }

        .driver-card {
            transition: all 0.3s ease;
            border-radius: 16px;
            overflow: hidden;
        }

        .driver-card:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .driver-status-indicator {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            border: 2px solid white;
        }

        .driver-status-online {
            background-color: var(--success);
            animation: pulse 2s infinite;
        }

        .driver-status-offline {
            background-color: var(--gray);
        }

        .mini-chart {
            height: 60px;
        }

        .search-input {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            background: white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            outline: none;
            border-color: var(--primary);
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

        .order-row {
            transition: all 0.2s ease;
        }

        .order-row:hover {
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
    @stack('styles')
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
            <a class="flex items-center p-3 rounded-lg nav-item active" href="#">
                <span class="material-icons-round mr-4">dashboard</span>
                <span class="sidebar-text">Dashboard</span>
            </a>
            <a class="flex items-center p-3 rounded-lg nav-item" href="#">
                <span class="material-icons-round mr-4">receipt_long</span>
                <span class="sidebar-text">Pesanan</span>
                <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-1">3</span>
            </a>
            <a class="flex items-center p-3 rounded-lg nav-item" href="#">
                <span class="material-icons-round mr-4">groups</span>
                <span class="sidebar-text">Pengguna</span>
            </a>
            <a class="flex items-center p-3 rounded-lg nav-item" href="#">
                <span class="material-icons-round mr-4">feedback</span>
                <span class="sidebar-text">Umpan Balik</span>
                <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-1">5</span>
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
                <button class="text-white opacity-70 hover:opacity-100" onclick="toggleDarkMode()">
                    <span class="material-icons-round">dark_mode</span>
                </button>
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
                <h2 class="text-2xl font-bold text-white">@yield('header', 'Dashboard')</h2>
                <p class="text-white/80 text-sm">@yield('subheader', 'Selamat datang kembali, Administrator Sistem. Berikut yang terjadi hari ini.')</p>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            <div class="relative">
                <input type="text" placeholder="Cari..." class="search-input pl-10 pr-4 text-gray-700">
                <span class="material-icons-round absolute left-3 top-2.5 text-gray-500">search</span>
            </div>

            <div class="relative">
                <button class="text-white hover:text-white/80 p-2 rounded-full hover:bg-white/20">
                    <span class="material-icons-round">notifications</span>
                    <span class="notification-badge">7</span>
                </button>
            </div>

            <button class="btn-primary px-4 py-2 font-medium flex items-center">
                <span class="material-icons-round text-sm mr-1">add</span>
                Pesanan Baru
            </button>
        </div>
    </header>

    <!-- Page Content -->
    <div class="flex-1 overflow-y-auto p-4 md:p-6">
        @yield('content')

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
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
                                        <a href="#" class="block dropdown-item text-sm text-gray-700">Proses Pengembalian</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="order-row border-b border-gray-200">
                            <td class="py-4 px-4 font-medium text-gray-900">#85740</td>
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <img alt="John Smith" class="w-8 h-8 rounded-full mr-3" src="https://picsum.photos/seed/john/40/40.jpg">
                                    <div>
                                        <div class="text-gray-900 font-medium">John Smith</div>
                                        <div class="text-gray-500 text-xs">john.s@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <img alt="William Davis" class="w-8 h-8 rounded-full mr-3" src="https://picsum.photos/seed/william/40/40.jpg">
                                    <div>
                                        <div class="text-gray-900 font-medium">William Davis</div>
                                        <div class="text-gray-500 text-xs">Nissan Altima</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-gray-900">19 Agt 2024</td>
                            <td class="py-4 px-4 text-gray-900">Rp 105.000</td>
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
                                    <button class="text-gray-500 hover:text-gray-900" onclick="toggleDropdown('order-3')">
                                        <span class="material-icons-round text-base">more_vert</span>
                                    </button>
                                    <div id="order-3" class="hidden absolute right-0 mt-2 w-48 dropdown-menu z-10">
                                        <a href="#" class="block dropdown-item text-sm text-gray-700">Lihat Detail</a>
                                        <a href="#" class="block dropdown-item text-sm text-gray-700">Unduh Invoice</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="order-row">
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
                                        <div class="text-gray-500 text-xs">Ford Fusion</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-gray-900">19 Agt 2024</td>
                            <td class="py-4 px-4 text-gray-900">Rp 60.000</td>
                            <td class="py-4 px-4">
                                <span class="status-pending">Menunggu</span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="progress-bar w-full">
                                    <div class="progress-fill bg-yellow-500" style="width: 60%"></div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="relative">
                                    <button class="text-gray-500 hover:text-gray-900" onclick="toggleDropdown('order-4')">
                                        <span class="material-icons-round text-base">more_vert</span>
                                    </button>
                                    <div id="order-4" class="hidden absolute right-0 mt-2 w-48 dropdown-menu z-10">
                                        <a href="#" class="block dropdown-item text-sm text-gray-700">Lihat Detail</a>
                                        <a href="#" class="block dropdown-item text-sm text-gray-700">Perbarui Status</a>
                                        <a href="#" class="block dropdown-item text-sm text-gray-700">Batalkan Pesanan</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Driver Status -->
        <div class="card p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Status Driver</h3>
                <a class="text-sm text-blue-600 hover:underline" href="#">Lihat Semua</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="driver-card relative bg-white rounded-xl p-4 border border-gray-100">
                    <div class="driver-status-indicator driver-status-online"></div>
                    <div class="flex items-center">
                        <img alt="Michael Brown" class="w-12 h-12 rounded-full mr-3" src="https://picsum.photos/seed/michael2/40/40.jpg">
                        <div>
                            <div class="text-gray-900 font-medium">Michael Brown</div>
                            <div class="text-gray-500 text-xs">Toyota Camry</div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                            <span>Rating</span>
                            <span>4.8</span>
                        </div>
                        <div class="progress-bar h-2">
                            <div class="progress-fill" style="width: 96%"></div>
                        </div>
                    </div>
                    <div class="mt-3 flex justify-between text-xs">
                        <span class="text-gray-500">Pesanan Hari Ini</span>
                        <span class="font-semibold">12</span>
                    </div>
                </div>
                <div class="driver-card relative bg-white rounded-xl p-4 border border-gray-100">
                    <div class="driver-status-indicator driver-status-online"></div>
                    <div class="flex items-center">
                        <img alt="Robert Johnson" class="w-12 h-12 rounded-full mr-3" src="https://picsum.photos/seed/robert2/40/40.jpg">
                        <div>
                            <div class="text-gray-900 font-medium">Robert Johnson</div>
                            <div class="text-gray-500 text-xs">Honda Accord</div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                            <span>Rating</span>
                            <span>4.6</span>
                        </div>
                        <div class="progress-bar h-2">
                            <div class="progress-fill" style="width: 92%"></div>
                        </div>
                    </div>
                    <div class="mt-3 flex justify-between text-xs">
                        <span class="text-gray-500">Pesanan Hari Ini</span>
                        <span class="font-semibold">8</span>
                    </div>
                </div>
                <div class="driver-card relative bg-white rounded-xl p-4 border border-gray-100">
                    <div class="driver-status-indicator driver-status-offline"></div>
                    <div class="flex items-center">
                        <img alt="William Davis" class="w-12 h-12 rounded-full mr-3" src="https://picsum.photos/seed/william2/40/40.jpg">
                        <div>
                            <div class="text-gray-900 font-medium">William Davis</div>
                            <div class="text-gray-500 text-xs">Nissan Altima</div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                            <span>Rating</span>
                            <span>4.9</span>
                        </div>
                        <div class="progress-bar h-2">
                            <div class="progress-fill" style="width: 98%"></div>
                        </div>
                    </div>
                    <div class="mt-3 flex justify-between text-xs">
                        <span class="text-gray-500">Pesanan Hari Ini</span>
                        <span class="font-semibold">15</span>
                    </div>
                </div>
                <div class="driver-card relative bg-white rounded-xl p-4 border border-gray-100">
                    <div class="driver-status-indicator driver-status-online"></div>
                    <div class="flex items-center">
                        <img alt="James Wilson" class="w-12 h-12 rounded-full mr-3" src="https://picsum.photos/seed/james2/40/40.jpg">
                        <div>
                            <div class="text-gray-900 font-medium">James Wilson</div>
                            <div class="text-gray-500 text-xs">Ford Fusion</div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                            <span>Rating</span>
                            <span>4.7</span>
                        </div>
                        <div class="progress-bar h-2">
                            <div class="progress-fill" style="width: 94%"></div>
                        </div>
                    </div>
                    <div class="mt-3 flex justify-between text-xs">
                        <span class="text-gray-500">Pesanan Hari Ini</span>
                        <span class="font-semibold">10</span>
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
                <span>13 ms</span>
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
            <a class="flex items-center p-3 rounded-lg nav-item active" href="#">
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

<!-- Floating Action Button -->
<div class="floating-action">
    <button class="bg-gradient-to-r from-purple-500 to-pink-500 text-white p-4 rounded-full shadow-lg hover:shadow-xl transition-all">
        <span class="material-icons-round">chat</span>
    </button>
</div>

<script>
    // Toggle dropdown menu
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        dropdown.classList.toggle('hidden');

        // Close other dropdowns
        document.querySelectorAll('[id^="order-"]').forEach(el => {
            if (el.id !== id) {
                el.classList.add('hidden');
            }
        });
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.relative')) {
            document.querySelectorAll('[id^="order-"]').forEach(el => {
                el.classList.add('hidden');
            });
        }
    });

    // Toggle mobile sidebar
    function toggleMobileSidebar() {
        const sidebar = document.getElementById('mobile-sidebar');
        const overlay = document.getElementById('mobile-menu-overlay');

        sidebar.classList.toggle('hidden');
        overlay.classList.toggle('active');
    }

    // Toggle dark mode
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
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

    // Initialize Chart
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
@stack('scripts')
</body>
</html>
