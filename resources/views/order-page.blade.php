<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Manajemen Pesanan - TaksiKu</title>
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

        .table-container {
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .table-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }

        .table-header {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .table-row {
            transition: all 0.2s ease;
        }

        .table-row:hover {
            background-color: rgba(99, 102, 241, 0.05);
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

        .status-cancelled {
            background: linear-gradient(135deg, #EF4444, #DC2626);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            box-shadow: 0 2px 10px rgba(239, 68, 68, 0.3);
        }

        .status-ongoing {
            background: linear-gradient(135deg, #F59E0B, #D97706);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            box-shadow: 0 2px 10px rgba(245, 158, 11, 0.3);
        }

        .payment-cash {
            background: linear-gradient(135deg, #F97316, #EA580C);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            box-shadow: 0 2px 10px rgba(249, 115, 22, 0.3);
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

        .dropdown-select {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            padding: 10px 16px;
            transition: all 0.3s ease;
        }

        .dropdown-select:focus {
            background: white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            outline: none;
            border-color: var(--primary);
        }

        .pagination-button {
            padding: 8px 12px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .pagination-button:hover {
            background-color: rgba(99, 102, 241, 0.1);
            transform: translateY(-2px);
        }

        .pagination-button.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
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
                <h2 class="text-2xl font-bold text-white">Manajemen Pesanan</h2>
                <p class="text-white/80 text-sm">Pantau dan kelola semua pesanan taksi</p>
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
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">5</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <div class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Search and Filter -->
        <div class="card p-6 mb-8">
            <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                <div class="flex-1 relative w-full">
                    <span class="material-icons-round absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                    <input class="search-input w-full pl-10 pr-4 py-2 text-gray-800" placeholder="Cari berdasarkan nama, telepon, driver, ID pesanan..." type="text"/>
                </div>
                <div class="flex items-center space-x-4 w-full md:w-auto">
                    <select class="dropdown-select text-gray-800 w-full md:w-auto">
                        <option>Semua Status</option>
                        <option>Aktif</option>
                        <option>Selesai</option>
                        <option>Dibatalkan</option>
                    </select>
                    <select class="dropdown-select text-gray-800 w-full md:w-auto">
                        <option>Semua Kendaraan</option>
                        <option>Motor</option>
                        <option>Mobil</option>
                    </select>
                </div>
                <div class="flex space-x-2 w-full md:w-auto">
                    <button class="btn-primary px-6 py-2 font-medium w-full md:w-auto flex items-center justify-center">
                        <span class="material-icons-round text-sm mr-2">search</span>
                        Cari
                    </button>
                    <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg transition w-full md:w-auto">
                        Reset
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Pesanan Selesai</p>
                        <p class="text-3xl font-bold mt-2">40</p>
                        <div class="flex items-center mt-3">
                            <span class="material-icons-round text-xs">trending_up</span>
                            <span class="text-xs ml-1">12% dari bulan lalu</span>
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
                        <p class="text-sm opacity-80">Pesanan Dibatalkan</p>
                        <p class="text-3xl font-bold mt-2">13</p>
                        <div class="flex items-center mt-3">
                            <span class="material-icons-round text-xs">trending_down</span>
                            <span class="text-xs ml-1">5% dari bulan lalu</span>
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">cancel</span>
                    </div>
                </div>
            </div>

            <div class="stat-card card p-6 text-gray-800" style="background: #f0f0f0ff; border: 1px solid #e5e7eb;">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Total Biaya Admin</p>
                        <p class="text-3xl font-bold mt-2">Rp 714.600</p>
                        <div class="flex items-center mt-3">
                            <span class="material-icons-round text-xs">trending_up</span>
                            <span class="text-xs ml-1">8% dari bulan lalu</span>
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">account_balance_wallet</span>
                    </div>
                </div>
            </div>

            <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Total Pendapatan</p>
                        <p class="text-3xl font-bold mt-2">Rp 2.325.000</p>
                        <div class="flex items-center mt-3">
                            <span class="material-icons-round text-xs">trending_up</span>
                            <span class="text-xs ml-1">15% dari bulan lalu</span>
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">attach_money</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="table-container p-6">
            <h3 class="text-xl font-semibold mb-4 text-gray-800">Daftar Pesanan</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-gray-200 text-gray-600">
                            <th class="py-3 px-2 font-medium">#</th>
                            <th class="py-3 px-2 font-medium">Pelanggan</th>
                            <th class="py-3 px-2 font-medium">Driver</th>
                            <th class="py-3 px-2 font-medium">Kendaraan</th>
                            <th class="py-3 px-2 font-medium">Jarak</th>
                            <th class="py-3 px-2 font-medium">Tarif</th>
                            <th class="py-3 px-2 font-medium">Pembayaran</th>
                            <th class="py-3 px-2 font-medium">Status</th>
                            <th class="py-3 px-2 font-medium">Dibuat</th>
                            <th class="py-3 px-2 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-row border-b border-gray-100">
                            <td class="py-4 px-2 font-semibold text-orange-500">1</td>
                            <td class="py-4 px-2">
                                <div class="flex items-center">
                                    <img src="https://picsum.photos/seed/user1/40/40.jpg" alt="User" class="w-8 h-8 rounded-full mr-2">
                                    <div>
                                        <p class="font-semibold text-gray-800">user</p>
                                        <p class="text-sm text-gray-500">+6281338</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-2">
                                <div class="flex items-center">
                                    <img src="https://picsum.photos/seed/driver1/40/40.jpg" alt="Driver" class="w-8 h-8 rounded-full mr-2">
                                    <div>
                                        <p class="font-semibold text-gray-800">test</p>
                                        <p class="text-sm text-gray-500">+6281338</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-2 text-gray-800">MOTORCYCLE</td>
                            <td class="py-4 px-2 text-gray-800">6.0km</td>
                            <td class="py-4 px-2">
                                <p class="font-semibold text-blue-600">Rp 714.750</p>
                                <p class="text-sm text-gray-500">Fee admin: Rp 178.688</p>
                            </td>
                            <td class="py-4 px-2"><span class="payment-cash">TUNAI</span></td>
                            <td class="py-4 px-2"><span class="status-ongoing">AKTIF</span></td>
                            <td class="py-4 px-2 text-gray-800">2 jam lalu</td>
                            <td class="py-4 px-2">
                                <button class="text-gray-500 hover:text-gray-800 p-1 rounded-full hover:bg-gray-100">
                                    <span class="material-icons-round">more_vert</span>
                                </button>
                            </td>
                        </tr>
                        <tr class="table-row border-b border-gray-100">
                            <td class="py-4 px-2 font-semibold text-orange-500">2</td>
                            <td class="py-4 px-2">
                                <div class="flex items-center">
                                    <img src="https://picsum.photos/seed/user2/40/40.jpg" alt="User" class="w-8 h-8 rounded-full mr-2">
                                    <div>
                                        <p class="font-semibold text-gray-800">user</p>
                                        <p class="text-sm text-gray-500">+6281338</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-2">
                                <div class="flex items-center">
                                    <img src="https://picsum.photos/seed/driver2/40/40.jpg" alt="Driver" class="w-8 h-8 rounded-full mr-2">
                                    <div>
                                        <p class="font-semibold text-gray-800">test</p>
                                        <p class="text-sm text-gray-500">+6281338</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-2 text-gray-800">MOTORCYCLE</td>
                            <td class="py-4 px-2 text-gray-800">6.0km</td>
                            <td class="py-4 px-2">
                                <p class="font-semibold text-blue-600">Rp 714.750</p>
                                <p class="text-sm text-gray-500">Fee admin: Rp 178.688</p>
                            </td>
                            <td class="py-4 px-2"><span class="payment-cash">TUNAI</span></td>
                            <td class="py-4 px-2"><span class="status-completed">SELESAI</span></td>
                            <td class="py-4 px-2 text-gray-800">2 jam lalu</td>
                            <td class="py-4 px-2">
                                <button class="text-gray-500 hover:text-gray-800 p-1 rounded-full hover:bg-gray-100">
                                    <span class="material-icons-round">more_vert</span>
                                </button>
                            </td>
                        </tr>
                        <tr class="table-row border-b border-gray-100">
                            <td class="py-4 px-2 font-semibold text-orange-500">3</td>
                            <td class="py-4 px-2">
                                <div class="flex items-center">
                                    <img src="https://picsum.photos/seed/user3/40/40.jpg" alt="User" class="w-8 h-8 rounded-full mr-2">
                                    <div>
                                        <p class="font-semibold text-gray-800">user</p>
                                        <p class="text-sm text-gray-500">+6281338</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-2">
                                <div class="flex items-center">
                                    <img src="https://picsum.photos/seed/driver3/40/40.jpg" alt="Driver" class="w-8 h-8 rounded-full mr-2">
                                    <div>
                                        <p class="font-semibold text-gray-800">test</p>
                                        <p class="text-sm text-gray-500">+6281338</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-2 text-gray-800">MOTORCYCLE</td>
                            <td class="py-4 px-2 text-gray-800">6.0km</td>
                            <td class="py-4 px-2">
                                <p class="font-semibold text-blue-600">Rp 714.750</p>
                                <p class="text-sm text-gray-500">Fee admin: Rp 178.688</p>
                            </td>
                            <td class="py-4 px-2"><span class="payment-cash">TUNAI</span></td>
                            <td class="py-4 px-2"><span class="status-cancelled">DIBATALKAN</span></td>
                            <td class="py-4 px-2 text-gray-800">2 jam lalu</td>
                            <td class="py-4 px-2">
                                <button class="text-gray-500 hover:text-gray-800 p-1 rounded-full hover:bg-gray-100">
                                    <span class="material-icons-round">more_vert</span>
                                </button>
                            </td>
                        </tr>
                        <tr class="table-row">
                            <td class="py-4 px-2 font-semibold text-orange-500">4</td>
                            <td class="py-4 px-2">
                                <div class="flex items-center">
                                    <img src="https://picsum.photos/seed/user4/40/40.jpg" alt="User" class="w-8 h-8 rounded-full mr-2">
                                    <div>
                                        <p class="font-semibold text-gray-800">user</p>
                                        <p class="text-sm text-gray-500">+6281338</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-2">
                                <div class="flex items-center">
                                    <img src="https://picsum.photos/seed/driver4/40/40.jpg" alt="Driver" class="w-8 h-8 rounded-full mr-2">
                                    <div>
                                        <p class="font-semibold text-gray-800">test</p>
                                        <p class="text-sm text-gray-500">+6281338</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-2 text-gray-800">MOTORCYCLE</td>
                            <td class="py-4 px-2 text-gray-800">6.0km</td>
                            <td class="py-4 px-2">
                                <p class="font-semibold text-blue-600">Rp 714.750</p>
                                <p class="text-sm text-gray-500">Fee admin: Rp 178.688</p>
                            </td>
                            <td class="py-4 px-2"><span class="payment-cash">TUNAI</span></td>
                            <td class="py-4 px-2"><span class="status-cancelled">DIBATALKAN</span></td>
                            <td class="py-4 px-2 text-gray-800">2 jam lalu</td>
                            <td class="py-4 px-2">
                                <button class="text-gray-500 hover:text-gray-800 p-1 rounded-full hover:bg-gray-100">
                                    <span class="material-icons-round">more_vert</span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex justify-between items-center mt-6">
                <div class="text-sm text-gray-500">Menampilkan 1 hingga 4 dari 20 entri</div>
                <nav class="inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                    <a href="#" class="pagination-button relative inline-flex items-center px-3 py-1 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500">Sebelumnya</a>
                    <a href="#" class="pagination-button relative inline-flex items-center px-3 py-1 border border-gray-300 bg-white text-sm font-medium text-gray-700 active">1</a>
                    <a href="#" class="pagination-button relative inline-flex items-center px-3 py-1 border border-gray-300 bg-white text-sm font-medium text-gray-700">2</a>
                    <a href="#" class="pagination-button relative inline-flex items-center px-3 py-1 border border-gray-300 bg-white text-sm font-medium text-gray-700">3</a>
                    <span class="relative inline-flex items-center px-3 py-1 border border-gray-300 bg-white text-sm font-medium text-gray-400">...</span>
                    <a href="#" class="pagination-button relative inline-flex items-center px-3 py-1 border border-gray-300 bg-white text-sm font-medium text-gray-700">5</a>
                    <a href="#" class="pagination-button relative inline-flex items-center px-3 py-1 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500">Selanjutnya</a>
                </nav>
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
