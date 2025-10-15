<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>TaksiKu - Manajemen Saldo</title>
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
            <a class="flex items-center p-3 rounded-lg nav-item active" href="#">
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
                <h2 class="text-2xl font-bold text-white">Manajemen Saldo</h2>
                <p class="text-white/80 text-sm">Kelola permintaan saldo driver dan penarikan dana</p>
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
                Permintaan Baru
            </button>
        </div>
    </header>

    <!-- Page Content -->
    <div class="flex-1 overflow-y-auto p-4 md:p-6">
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

            <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #6366F1 0%, #4F46E5 100%);">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Total Permintaan</p>
                        <p class="text-3xl font-bold mt-2">3</p>
                        <div class="flex items-center mt-3">
                            <span class="material-icons-round text-xs">grid_on</span>
                            <span class="text-xs ml-1">Semua permintaan saldo</span>
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">grid_on</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Balance Requests Table -->
        <div class="card p-6 mb-8">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Permintaan Saldo</h3>
                <div class="flex items-center space-x-4">
                    <select class="border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>Semua Status</option>
                        <option>Disetujui</option>
                        <option>Menunggu</option>
                        <option>Ditolak</option>
                    </select>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-800">
                    <thead class="border-b border-gray-200 text-xs uppercase text-gray-500">
                        <tr>
                            <th class="py-3 px-4" scope="col">#</th>
                            <th class="py-3 px-4" scope="col">Driver</th>
                            <th class="py-3 px-4" scope="col">Jumlah</th>
                            <th class="py-3 px-4" scope="col">Deskripsi</th>
                            <th class="py-3 px-4" scope="col">Status</th>
                            <th class="py-3 px-4" scope="col">Dibuat</th>
                            <th class="py-3 px-4" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="balance-row border-b border-gray-200">
                            <td class="py-4 px-4 font-medium text-gray-900">1</td>
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <img alt="test" class="w-8 h-8 rounded-full mr-3" src="https://picsum.photos/seed/driver1/40/40.jpg">
                                    <div>
                                        <div class="text-gray-900 font-medium">test</div>
                                        <div class="text-gray-500 text-xs">drivertest2@gmail.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-gray-900">Rp 10.000</td>
                            <td class="py-4 px-4 text-gray-900">Test</td>
                            <td class="py-4 px-4">
                                <span class="status-completed">DISETUJUI</span>
                            </td>
                            <td class="py-4 px-4 text-gray-900">1 Sep 2025</td>
                            <td class="py-4 px-4">
                                <div class="relative">
                                    <button class="text-gray-500 hover:text-gray-900" onclick="openModal(1)">
                                        <span class="material-icons-round text-base">more_horiz</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="balance-row border-b border-gray-200">
                            <td class="py-4 px-4 font-medium text-gray-900">2</td>
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <img alt="test" class="w-8 h-8 rounded-full mr-3" src="https://picsum.photos/seed/driver2/40/40.jpg">
                                    <div>
                                        <div class="text-gray-900 font-medium">test</div>
                                        <div class="text-gray-500 text-xs">drivertest2@gmail.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-gray-900">Rp 10.000</td>
                            <td class="py-4 px-4 text-gray-900">Test</td>
                            <td class="py-4 px-4">
                                <span class="status-pending">MENUNGGU</span>
                            </td>
                            <td class="py-4 px-4 text-gray-900">1 Sep 2025</td>
                            <td class="py-4 px-4">
                                <div class="relative">
                                    <button class="text-gray-500 hover:text-gray-900" onclick="openModal(2)">
                                        <span class="material-icons-round text-base">more_horiz</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="balance-row border-b border-gray-200">
                            <td class="py-4 px-4 font-medium text-gray-900">3</td>
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <img alt="test" class="w-8 h-8 rounded-full mr-3" src="https://picsum.photos/seed/driver3/40/40.jpg">
                                    <div>
                                        <div class="text-gray-900 font-medium">test</div>
                                        <div class="text-gray-500 text-xs">drivertest2@gmail.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-gray-900">Rp 10.000</td>
                            <td class="py-4 px-4 text-gray-900">Test</td>
                            <td class="py-4 px-4">
                                <span class="status-cancelled">DITOLAK</span>
                            </td>
                            <td class="py-4 px-4 text-gray-900">1 Sep 2025</td>
                            <td class="py-4 px-4">
                                <div class="relative">
                                    <button class="text-gray-500 hover:text-gray-900" onclick="openModal(3)">
                                        <span class="material-icons-round text-base">more_horiz</span>
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
            <a class="flex items-center p-3 rounded-lg nav-item active" href="#">
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

<!-- Modal for Balance Request Details -->
<div id="balanceModal" class="modal-overlay">
    <div class="modal-content">
        <header class="flex items-center justify-between p-6 border-b">
            <div class="flex items-center">
                <button class="text-gray-500 hover:text-gray-700 mr-4" onclick="closeModal()">
                    <span class="material-icons-round">arrow_back</span>
                </button>
                <h1 class="text-xl font-bold text-gray-800">Detail Permintaan Saldo</h1>
            </div>
        </header>
        <main class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="flex flex-col space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1" for="amount">Jumlah</label>
                        <div class="relative">
                            <input class="w-full pl-4 pr-16 py-3 text-2xl font-bold text-gray-800 border-gray-200 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500" id="amount" readonly="" type="text" value="Rp 50.000" />
                            <span class="absolute inset-y-0 right-0 pr-4 flex items-center text-base text-gray-500 font-medium">IDR</span>
                        </div>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg flex flex-col flex-grow">
                        <p class="text-sm font-medium text-gray-500 mb-4">Informasi Pembayaran Pengguna</p>
                        <div class="space-y-3 flex-grow">
                            <div class="flex justify-between">
                                <p class="text-sm text-gray-500">Nama</p>
                                <p class="text-sm font-semibold text-gray-800">Jane Doe</p>
                            </div>
                            <div class="flex justify-between">
                                <p class="text-sm text-gray-500">ID Transaksi</p>
                                <p class="text-sm font-semibold text-gray-800">TRX123456789</p>
                            </div>
                            <div class="flex justify-between">
                                <p class="text-sm text-gray-500">Tanggal</p>
                                <p class="text-sm font-semibold text-gray-800">26 Oktober 2023</p>
                            </div>
                            <div class="flex justify-between">
                                <p class="text-sm text-gray-500">Waktu</p>
                                <p class="text-sm font-semibold text-gray-800">10:30 AM</p>
                            </div>
                            <div class="flex justify-between">
                                <p class="text-sm text-gray-500">Metode Pembayaran</p>
                                <p class="text-sm font-semibold text-gray-800">Transfer Bank</p>
                            </div>
                            <div class="flex justify-between">
                                <p class="text-sm text-gray-500">Nomor Rekening</p>
                                <p class="text-sm font-semibold text-gray-800">1234-5678-9012-3456</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="flex-grow p-4 border-2 border-dashed border-gray-200 rounded-lg flex items-center justify-center">
                        <div class="text-center">
                            <p class="text-sm text-gray-500 mb-2">Bukti Transfer</p>
                            <img alt="Bukti transfer" class="rounded-lg max-h-64 w-auto object-contain" src="https://picsum.photos/seed/transfer/300/200.jpg" />
                        </div>
                    </div>
                    <button class="w-full py-3 mt-4 text-center text-indigo-600 font-semibold bg-indigo-50 border border-indigo-200 rounded-lg hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Lihat Foto Lengkap</button>
                </div>
            </div>
            <div class="mt-8 grid grid-cols-2 gap-4">
                <button class="w-full py-3 text-center text-white font-bold bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 text-base">Terima</button>
                <button class="w-full py-3 text-center text-white font-bold bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 text-base">Tolak</button>
            </div>
        </main>
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

    // Modal functions
    function openModal(id) {
        const modal = document.getElementById('balanceModal');
        modal.classList.add('active');

        // Here you would typically load the data for the specific request
        // For demo purposes, we're just showing the modal
    }

    function closeModal() {
        const modal = document.getElementById('balanceModal');
        modal.classList.remove('active');
    }

    // Close modal if user clicks on the background overlay
    document.getElementById('balanceModal').addEventListener('click', (event) => {
        if (event.target === event.currentTarget) {
            closeModal();
        }
    });
</script>
</body>
</html>
