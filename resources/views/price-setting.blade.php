<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>TaksiKu - Pengaturan Harga</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet"/>
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

        .price-row {
            transition: all 0.2s ease;
        }

        .price-row:hover {
            background-color: rgba(99, 102, 241, 0.05);
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

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            transform: translateX(120%);
            transition: transform 0.3s ease;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.success {
            background-color: var(--success);
        }

        .notification.error {
            background-color: var(--danger);
        }

        .notification.info {
            background-color: var(--primary);
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
            <a class="flex items-center p-3 rounded-lg nav-item active" href="#">
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
                <h2 class="text-2xl font-bold text-white">Pengaturan Harga</h2>
                <p class="text-white/80 text-sm">Kelola harga kendaraan berdasarkan jarak dan tipe</p>
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
                Aturan Baru
            </button>
        </div>
    </header>

    <!-- Page Content -->
    <div class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="card p-6 text-white" style="background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%);">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Total Aturan</p>
                        <p class="text-3xl font-bold mt-2">6</p>
                        <div class="flex items-center mt-3">
                            <span class="material-icons-round text-xs">rule</span>
                            <span class="text-xs ml-1">Semua aturan harga</span>
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">rule</span>
                    </div>
                </div>
            </div>

            <div class="card p-6 text-white" style="background: linear-gradient(135deg, #10B981 0%, #14B8A6 100%);">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Jarak Maksimal</p>
                        <p class="text-3xl font-bold mt-2">50 km</p>
                        <div class="flex items-center mt-3">
                            <span class="material-icons-round text-xs">straighten</span>
                            <span class="text-xs ml-1">Radius maksimal</span>
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">straighten</span>
                    </div>
                </div>
            </div>

            <div class="card p-6 text-white" style="background: linear-gradient(135deg, #F59E0B 0%, #F97316 100%);">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Harga Terendah</p>
                        <p class="text-3xl font-bold mt-2">Rp 8.000</p>
                        <div class="flex items-center mt-3">
                            <span class="material-icons-round text-xs">trending_down</span>
                            <span class="text-xs ml-1">Motor 0-5 km</span>
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">trending_down</span>
                    </div>
                </div>
            </div>

            <div class="card p-6 text-white" style="background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Harga Tertinggi</p>
                        <p class="text-3xl font-bold mt-2">Rp 35.000</p>
                        <div class="flex items-center mt-3">
                            <span class="material-icons-round text-xs">trending_up</span>
                            <span class="text-xs ml-1">Mobil 10-20 km</span>
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">trending_up</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pricing Rules Table -->
        <div class="card p-6 mb-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-800">Aturan Harga</h3>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <label class="text-sm font-medium text-gray-700" for="sort-by">Urutkan:</label>
                        <select
                            class="w-auto px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            id="sort-by" name="sort-by">
                            <option value="vehicle-type">Tipe Kendaraan</option>
                            <option value="distance">Jarak</option>
                            <option value="price">Harga</option>
                        </select>
                    </div>
                    <button id="addNewRuleBtn"
                        class="btn-primary px-4 py-2 rounded-lg flex items-center">
                        <span class="material-icons-round mr-2">add</span> Tambah Aturan
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="max-radius">Radius Maksimal (km)</label>
                    <input
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        id="max-radius" name="max-radius" type="number" value="50" />
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left rounded-l-lg">
                                <div class="flex items-center cursor-pointer">
                                    <span>Tipe Kendaraan</span>
                                    <span class="material-icons-round text-sm ml-1 text-gray-400">unfold_more</span>
                                </div>
                            </th>
                            <th class="py-3 px-6 text-left">
                                <div class="flex items-center cursor-pointer">
                                    <span>Jarak (km)</span>
                                    <span class="material-icons-round text-sm ml-1">arrow_upward</span>
                                </div>
                            </th>
                            <th class="py-3 px-6 text-left">Harga</th>
                            <th class="py-3 px-6 text-center rounded-r-lg">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm font-light">
                        <tr class="border-b border-gray-200 price-row">
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <span class="material-icons-round text-indigo-500 mr-2">two_wheeler</span>
                                    <span>Motor</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">0 - 5 km</td>
                            <td class="py-4 px-6">Rp 8.000</td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <button class="w-6 h-6 rounded-full text-blue-600 hover:bg-blue-100 mr-2">
                                        <span class="material-icons-round text-base">edit</span>
                                    </button>
                                    <button class="w-6 h-6 rounded-full text-red-600 hover:bg-red-100">
                                        <span class="material-icons-round text-base">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200 price-row">
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <span class="material-icons-round text-indigo-500 mr-2">two_wheeler</span>
                                    <span>Motor</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">5 - 10 km</td>
                            <td class="py-4 px-6">Rp 12.000</td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <button class="w-6 h-6 rounded-full text-blue-600 hover:bg-blue-100 mr-2">
                                        <span class="material-icons-round text-base">edit</span>
                                    </button>
                                    <button class="w-6 h-6 rounded-full text-red-600 hover:bg-red-100">
                                        <span class="material-icons-round text-base">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200 price-row">
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <span class="material-icons-round text-indigo-500 mr-2">two_wheeler</span>
                                    <span>Motor</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">10 - 20 km</td>
                            <td class="py-4 px-6">Rp 20.000</td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <button class="w-6 h-6 rounded-full text-blue-600 hover:bg-blue-100 mr-2">
                                        <span class="material-icons-round text-base">edit</span>
                                    </button>
                                    <button class="w-6 h-6 rounded-full text-red-600 hover:bg-red-100">
                                        <span class="material-icons-round text-base">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200 price-row">
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <span class="material-icons-round text-green-500 mr-2">directions_car</span>
                                    <span>Mobil</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">0 - 5 km</td>
                            <td class="py-4 px-6">Rp 15.000</td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <button class="w-6 h-6 rounded-full text-blue-600 hover:bg-blue-100 mr-2">
                                        <span class="material-icons-round text-base">edit</span>
                                    </button>
                                    <button class="w-6 h-6 rounded-full text-red-600 hover:bg-red-100">
                                        <span class="material-icons-round text-base">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200 price-row">
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <span class="material-icons-round text-green-500 mr-2">directions_car</span>
                                    <span>Mobil</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">5 - 10 km</td>
                            <td class="py-4 px-6">Rp 22.000</td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <button class="w-6 h-6 rounded-full text-blue-600 hover:bg-blue-100 mr-2">
                                        <span class="material-icons-round text-base">edit</span>
                                    </button>
                                    <button class="w-6 h-6 rounded-full text-red-600 hover:bg-red-100">
                                        <span class="material-icons-round text-base">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="price-row">
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <span class="material-icons-round text-green-500 mr-2">directions_car</span>
                                    <span>Mobil</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">10 - 20 km</td>
                            <td class="py-4 px-6">Rp 35.000</td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <button class="w-6 h-6 rounded-full text-blue-600 hover:bg-blue-100 mr-2">
                                        <span class="material-icons-round text-base">edit</span>
                                    </button>
                                    <button class="w-6 h-6 rounded-full text-red-600 hover:bg-red-100">
                                        <span class="material-icons-round text-base">delete</span>
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
        <p>© 2025 TaksiKu. Semua hak dilindungi.</p>
        <div class="flex items-center space-x-6">
            <div class="flex items-center space-x-2">
                <span class="material-icons-round text-base">speed</span>
                <span>28 ms</span>
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
            <a class="flex items-center p-3 rounded-lg nav-item active" href="#">
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

<!-- Add New Rule Modal -->
<div id="addRuleModal" class="modal-overlay">
    <div class="modal-content">
        <div class="flex justify-between items-center p-6 border-b">
            <h1 class="text-xl font-bold text-gray-800">Tambah Aturan Harga Baru</h1>
            <button id="closeModalBtn" class="text-gray-500 hover:text-gray-700">
                <span class="material-icons-round">close</span>
            </button>
        </div>
        <form class="p-6 space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2" for="vehicle-type">Tipe Kendaraan</label>
                <select class="w-full h-12 px-4 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-700" id="vehicle-type" name="vehicle-type">
                    <option>Pilih Tipe Kendaraan</option>
                    <option value="Motor">Motor</option>
                    <option value="Mobil">Mobil</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Rentang Jarak (km)</label>
                <div class="flex items-center space-x-4">
                    <input class="w-full h-12 px-4 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-700" id="min-distance" name="min-distance" placeholder="Minimum" type="number"/>
                    <span class="text-gray-500">-</span>
                    <input class="w-full h-12 px-4 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-700" id="max-distance" name="max-distance" placeholder="Maksimum" type="number"/>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2" for="price">Harga</label>
                <div class="relative rounded-md shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <span class="text-gray-500 sm:text-sm">Rp</span>
                    </div>
                    <input class="w-full h-12 pl-12 pr-4 bg-gray-50 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-gray-700" id="price" name="price" placeholder="0" type="number"/>
                </div>
            </div>
            <div class="flex justify-end space-x-4 pt-4">
                <button id="cancelModalBtn" class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-md shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300" type="button">
                    Batal
                </button>
                <button class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" type="submit">
                    Tambah Aturan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Notification Container -->
<div id="notification" class="notification"></div>

<script>
    // Get modal elements
    const addNewRuleBtn = document.getElementById('addNewRuleBtn');
    const addRuleModal = document.getElementById('addRuleModal');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const cancelModalBtn = document.getElementById('cancelModalBtn');
    const notification = document.getElementById('notification');

    // Show modal
    addNewRuleBtn.addEventListener('click', () => {
        addRuleModal.classList.add('active');
    });

    // Hide modal with close button
    closeModalBtn.addEventListener('click', () => {
        addRuleModal.classList.remove('active');
    });

    // Hide modal with cancel button
    cancelModalBtn.addEventListener('click', () => {
        addRuleModal.classList.remove('active');
    });

    // Hide modal when clicking outside of it
    window.addEventListener('click', (event) => {
        if (event.target == addRuleModal) {
            addRuleModal.classList.remove('active');
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

    // Show notification
    function showNotification(message, type = 'info') {
        notification.textContent = message;
        notification.className = `notification ${type}`;
        notification.classList.add('show');

        setTimeout(() => {
            notification.classList.remove('show');
        }, 3000);
    }

    // Handle form submission
    document.querySelector('form').addEventListener('submit', (e) => {
        e.preventDefault();

        // Get form values
        const vehicleType = document.getElementById('vehicle-type').value;
        const minDistance = document.getElementById('min-distance').value;
        const maxDistance = document.getElementById('max-distance').value;
        const price = document.getElementById('price').value;

        // Validate form
        if (!vehicleType || !minDistance || !maxDistance || !price) {
            showNotification('Mohon lengkapi semua field', 'error');
            return;
        }

        // Add new row to table
        const tableBody = document.querySelector('tbody');
        const newRow = document.createElement('tr');
        newRow.className = 'border-b border-gray-200 price-row';

        const vehicleIcon = vehicleType === 'Motor' ? 'two_wheeler' : 'directions_car';
        const vehicleColor = vehicleType === 'Motor' ? 'text-indigo-500' : 'text-green-500';

        newRow.innerHTML = `
            <td class="py-4 px-6">
                <div class="flex items-center">
                    <span class="material-icons-round ${vehicleColor} mr-2">${vehicleIcon}</span>
                    <span>${vehicleType}</span>
                </div>
            </td>
            <td class="py-4 px-6">${minDistance} - ${maxDistance} km</td>
            <td class="py-4 px-6">Rp ${parseInt(price).toLocaleString('id-ID')}</td>
            <td class="py-4 px-6 text-center">
                <div class="flex item-center justify-center">
                    <button class="w-6 h-6 rounded-full text-blue-600 hover:bg-blue-100 mr-2">
                        <span class="material-icons-round text-base">edit</span>
                    </button>
                    <button class="w-6 h-6 rounded-full text-red-600 hover:bg-red-100">
                        <span class="material-icons-round text-base">delete</span>
                    </button>
                </div>
            </td>
        `;

        tableBody.appendChild(newRow);

        // Close modal
        addRuleModal.classList.remove('active');

        // Reset form
        document.querySelector('form').reset();

        // Show success notification
        showNotification('Aturan harga berhasil ditambahkan', 'success');

        // Update stats
        updateStats();
    });

    // Update stats function
    function updateStats() {
        const totalRules = document.querySelectorAll('tbody tr').length;
        document.querySelector('.card:first-child .text-3xl').textContent = totalRules;
    }
</script>
</body>
</html>
