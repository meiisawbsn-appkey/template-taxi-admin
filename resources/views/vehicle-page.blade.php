<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Tambah Kendaraan - TaksiKu</title>
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

        .btn-secondary {
            background: #e5e7eb;
            color: #6b7280;
            transition: all 0.3s ease;
            border-radius: 12px;
        }

        .btn-secondary:hover {
            background: #d1d5db;
            color: #4b5563;
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

        .table-row {
            transition: all 0.2s ease;
        }

        .table-row:hover {
            background-color: rgba(99, 102, 241, 0.05);
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

        .action-button {
            padding: 8px;
            border-radius: 8px;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .action-button:hover {
            background-color: rgba(99, 102, 241, 0.1);
            transform: translateY(-2px);
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 50;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 20px 30px;
            border-radius: 20px 20px 0 0;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .modal-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-input {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .form-input:focus {
            background: white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            outline: none;
            border-color: var(--primary);
        }

        .form-select {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .form-select:focus {
            background: white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            outline: none;
            border-color: var(--primary);
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 30px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        .toggle-switch input:checked + .toggle-slider {
            background-color: var(--primary);
        }

        .toggle-switch input:checked + .toggle-slider:before {
            transform: translateX(30px);
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
                <h2 class="text-2xl font-bold text-white">Kendaraan</h2>
                <p class="text-white/80 text-sm">Kelola semua kendaraan driver</p>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            <div class="relative">
                <input type="text" placeholder="Cari..." class="search-input pl-10 pr-4 text-gray-700">
                <span class="material-icons-round absolute left-3 top-2.5 text-gray-500">search</span>
                </div>
            </div>

            <div class="relative">
                <button class="text-white hover:text-white/80 p-2 rounded-full hover:bg-white/20" onclick="openModal()">
                    <span class="material-icons-round">add</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <div class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="card p-6 text-gray-800" style="background: #f0f0f0ff; border: 1px solid #e5e7eb;">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Total Kendaraan</p>
                        <p class="text-3xl font-bold mt-2">5</p>
                        <div class="flex items-center mt-3">
                            <span class="material-icons-round text-xs">trending_up</span>
                            <span class="text-xs ml-1">2 baru bulan ini</span>
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">directions_car</span>
                    </div>
                </div>
            </div>

            <div class="card p-6 text-white" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Kendaraan Aktif</p>
                        <p class="text-3xl font-bold mt-2">1</p>
                        <div class="flex items-center mt-3">
                            <span class="material-icons-round text-xs">check_circle</span>
                            <span class="text-xs ml-1">20% dari total</span>
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">verified</span>
                    </div>
                </div>
            </div>

            <div class="card p-6 text-white" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Kendaraan Motor</p>
                        <p class="text-3xl font-bold mt-2">5</p>
                        <div class="flex items-center mt-3">
                            <span class="material-icons-round text-xs">two_wheeler</span>
                            <span class="text-xs ml-1">100% dari total</span>
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">motorcycle</span>
                    </div>
                </div>
            </div>

            <div class="card p-6 text-white" style="background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Kendaraan Mobil</p>
                        <p class="text-3xl font-bold mt-2">0</p>
                        <div class="flex items-center mt-3">
                            <span class="material-icons-round text-xs">directions_car</span>
                            <span class="text-xs ml-1">Belum tersedia</span>
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">no_crash</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="card p-6 mb-8">
            <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                <div class="flex-1 relative w-full">
                    <span class="material-icons-round absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                    <input class="search-input w-full pl-10 pr-4 py-2 text-gray-800" placeholder="Cari kendaraan..." type="text"/>
                </div>
                <div class="flex items-center space-x-4 w-full md:w-auto">
                    <select class="dropdown-select text-gray-800 w-full md:w-auto">
                        <option>Semua Tipe Kendaraan</option>
                        <option>Motor</option>
                        <option>Mobil</option>
                    </select>
                    <select class="dropdown-select text-gray-800 w-full md:w-auto">
                        <option>Semua Status</option>
                        <option>Aktif</option>
                        <option>Tidak Aktif</option>
                    </select>
                </div>
            </div>

        <!-- Vehicles Table -->
        <div class="table-container p-6">
            <h3 class="text-xl font-semibold mb-4 text-gray-800">Daftar Kendaraan</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-gray-200 text-gray-600">
                            <th class="py-3 px-2 font-medium">#</th>
                            <th class="py-3 px-2 font-medium">Kendaraan</th>
                            <th class="py-3 px-2 font-medium">Driver</th>
                            <th class="py-3 px-2 font-medium">Status</th>
                            <th class="py-3 px-2 font-medium">Dibuat</th>
                            <th class="py-3 px-2 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-row border-b border-gray-100">
                            <td class="py-4 px-2">
                                <div class="flex items-center">
                                    <img src="https://picsum.photos/seed/honda-beat/50/50.jpg" alt="Honda Beat" class="w-10 h-10 rounded-lg mr-3 object-cover">
                                    <div>
                                        <p class="font-semibold text-gray-800">Honda Beat 2020</p>
                                        <p class="text-sm text-gray-500">B1234BCA123</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-2">
                                <div class="flex items-center">
                                    <img src="https://picsum.photos/seed/driver1/40/40.jpg" alt="Driver" class="w-8 h-8 rounded-full mr-2">
                                    <div>
                                        <p class="font-semibold text-gray-800">Tessy</p>
                                        <p class="text-sm text-gray-500">+628123456789</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-2"><span class="status-inactive">TIDAK AKTIF</span></td>
                            <td class="py-4 px-2 text-gray-800">1 Sep 2025</td>
                            <td class="py-4 px-2">
                                <div class="flex space-x-2">
                                    <button class="action-button text-gray-500 hover:text-blue-600" onclick="viewVehicle('1')">
                                        <span class="material-icons-round">visibility</span>
                                    </button>
                                    <button class="action-button text-gray-500 hover:text-green-600" onclick="editVehicle('1')">
                                        <span class="material-icons-round">edit</span>
                                    </button>
                                    <button class="action-button text-gray-500 hover:text-red-600" onclick="deleteVehicle('1')">
                                        <span class="material-icons-round">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-row border-b border-gray-100">
                            <td class="py-4 px-2">
                                <div class="flex items-center">
                                    <img src="https://picsum.photos/seed/honda-beat2/50/50.jpg" alt="Honda Beat" class="w-10 h-10 rounded-lg mr-3 object-cover">
                                    <div>
                                        <p class="font-semibold text-gray-800">Honda Beat 2020</p>
                                        <p class="text-sm text-gray-500">A1234BBC</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-2">
                                <div class="flex items-center">
                                    <img src="https://picsum.photos/seed/driver2/40/40.jpg" alt="Driver" class="w-8 h-8 rounded-full mr-2">
                                    <div>
                                        <p class="font-semibold text-gray-800">Tessy</p>
                                        <p class="text-sm text-gray-500">+628123456789</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-2"><span class="status-active">AKTIF</span></td>
                            <td class="py-4 px-2 text-gray-800">29 Agu 2025</td>
                            <td class="py-4 px-2">
                                <div class="flex space-x-2">
                                    <button class="action-button text-gray-500 hover:text-blue-600" onclick="viewVehicle('2')">
                                        <span class="material-icons-round">visibility</span>
                                    </button>
                                    <button class="action-button text-gray-500 hover:text-green-600" onclick="editVehicle('2')">
                                        <span class="material-icons-round">edit</span>
                                    </button>
                                    <button class="action-button text-gray-500 hover:text-red-600" onclick="deleteVehicle('2')">
                                        <span class="material-icons-round">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-row border-b border-gray-100">
                            <td class="py-4 px-2">
                                <div class="flex items-center">
                                    <img src="https://picsum.photos/seed/honda-beat3/50/50.jpg" alt="Honda Beat" class="w-10 h-10 rounded-lg mr-3 object-cover">
                                    <div>
                                        <p class="font-semibold text-gray-800">Honda Beat 2020</p>
                                        <p class="text-sm text-gray-500">B1234ABAaCA</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-2">
                                <div class="flex items-center">
                                    <img src="https://picsum.photos/seed/driver3/40/40.jpg" alt="Driver" class="w-8 h-8 rounded-full mr-2">
                                    <div>
                                        <p class="font-semibold text-gray-800">Tessy</p>
                                        <p class="text-sm text-gray-500">+628123456789</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-2"><span class="status-inactive">TIDAK AKTIF</span></td>
                            <td class="py-4 px-2 text-gray-800">25 Agu 2025</td>
                            <td class="py-4 px-2">
                                <div class="flex space-x-2">
                                    <button class="action-button text-gray-500 hover:text-blue-600" onclick="viewVehicle('3')">
                                        <span class="material-icons-round">visibility</span>
                                    </button>
                                    <button class="action-button text-gray-500 hover:text-green-600" onclick="editVehicle('3')">
                                        <span class="material-icons-round">edit</span>
                                    </button>
                                    <button class="action-button text-gray-500 hover:text-red-600" onclick="deleteVehicle('3')">
                                        <span class="material-icons-round">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-row">
                            <td class="py-4 px-2">
                                <div class="flex items-center">
                                    <img src="https://picsum.photos/seed/honda-beat4/50/50.jpg" alt="Honda Beat" class="w-10 h-10 rounded-lg mr-3 object-cover">
                                    <div>
                                        <p class="font-semibold text-gray-800">Honda Beat</p>
                                        <p class="text-sm text-gray-500">B1234BCA</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-2">
                                <div class="flex items-center">
                                    <img src="https://picsum.photos/seed/driver4/40/40.jpg" alt="Driver" class="w-8 h-8 rounded-full mr-2">
                                    <div>
                                        <p class="font-semibold text-gray-800">Tessy</p>
                                        <p class="text-sm text-gray-500">+628123456789</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-2"><span class="status-inactive">TIDAK AKTIF</span></td>
                            <td class="py-4 px-2 text-gray-800">23 Agu 2025</td>
                            <td class="py-4 px-2">
                                <div class="flex space-x-2">
                                    <button class="action-button text-gray-500 hover:text-blue-600" onclick="viewVehicle('4')">
                                        <span class="material-icons-round">visibility</span>
                                    </button>
                                    <button class="action-button text-gray-500 hover:text-green-600" onclick="editVehicle('4')">
                                        <span class="material-icons-round">edit</span>
                                    </button>
                                    <button class="action-button text-gray-500 hover:text-red-600" onclick="deleteVehicle('4')">
                                        <span class="material-icons-round">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
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

<!-- Add Vehicle Modal -->
<div class="modal-overlay" id="addVehicleModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="text-2xl font-bold text-white">Tambah Kendaraan Baru</h2>
            <button class="modal-close" onclick="closeModal()">
                <span class="material-icons-round text-white">close</span>
            </button>
        </div>

        <form class="p-6" onsubmit="saveVehicle(event)">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-group">
                    <label class="form-label" for="driver">Driver <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select class="form-select" id="driver" required>
                            <option value="">Pilih driver</option>
                            <option value="1">Tessy</option>
                            <option value="2">Budi Santoso</option>
                            <option value="3">Ahmad Fauzi</option>
                        </select>
                        <span class="material-icons-round absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">expand_more</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="vehicle_name">Nama Kendaraan <span class="text-red-500">*</span></label>
                    <input class="form-input" id="vehicle_name" placeholder="e.g. Honda Beat 2020" required type="text"/>
                </div>
                <div class="form-group">
                    <label class="form-label" for="vehicle_type">Tipe Kendaraan <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select class="form-select" id="vehicle_type" required>
                            <option value="">Pilih tipe kendaraan</option>
                            <option value="MOTORCYCLE">Motor</option>
                            <option value="CAR">Mobil</option>
                        </select>
                        <span class="material-icons-round absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">expand_more</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="plate_number">Nomor Plat <span class="text-red-500">*</span></label>
                    <input class="form-input" id="plate_number" placeholder="e.g. B1234ABC" required type="text"/>
                </div>
                <div class="form-group">
                    <label class="form-label" for="status">Status</label>
                    <div class="toggle-switch">
                        <input type="checkbox" id="status" class="hidden" checked>
                        <label class="toggle-slider" for="status"></label>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4 mt-6">
                <button type="button" class="btn-secondary px-6 py-2 font-medium" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn-primary px-6 py-2 font-medium">Simpan Kendaraan</button>
            </div>
        </form>
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
            toggleBtn.textContent = 'modal-close';
        }
    }

    // Modal functions
    function openModal() {
        document.getElementById('addVehicleModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('addVehicleModal').classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    // Vehicle actions
    function viewVehicle(id) {
        // Redirect to vehicle details page
        window.location.href = 'vehicle-details.html?id=' + id;
    }

    function editVehicle(id) {
        // Open edit modal with pre-filled data
        openModal();
        // Pre-fill form with vehicle data
        // This would typically fetch data from an API
    }

    function deleteVehicle(id) {
        if (confirm('Apakah Anda yakin ingin menghapus kendaraan ini?')) {
            // Delete vehicle via API
            console.log('Deleting vehicle with ID:', id);
            // Reload page after deletion
            location.reload();
        }
    }

    // Save vehicle
    function saveVehicle(event) {
        event.preventDefault();

        // Get form values
        const driver = document.getElementById('driver').value;
        const vehicleName = document.getElementById('vehicle_name').value;
        const vehicleType = document.getElementById('vehicle_type').value;
        const plateNumber = document.getElementById('plate_number').value;
        const status = document.getElementById('status').checked;

        // Validate form
        if (!driver || !vehicleName || !vehicleType || !plateNumber) {
            alert('Mohon lengkapi semua field yang diperlukan');
            return;
        }

        // Create vehicle object
        const vehicleData = {
            driver: driver,
            vehicleName: vehicleName,
            vehicleType: vehicleType,
            plateNumber: plateNumber,
            status: status ? 'active' : 'inactive'
        };

        // Save via API
        console.log('Saving vehicle:', vehicleData);

        // Close modal and reload page
        closeModal();

        // Show success message
        const successMessage = document.createElement('div');
        successMessage.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
        successMessage.innerHTML = `
            <div class="flex items-center">
                <span class="material-icons-round mr-2">check_circle</span>
                <span>Kendaraan berhasil ditambahkan!</span>
            </div>
        `;
        document.body.appendChild(successMessage);

        // Remove message after 3 seconds
        setTimeout(() => {
            successMessage.remove();
            location.reload();
        }, 3000);
    }
</script>
</body>
</html>
