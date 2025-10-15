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
                        <p class="text-3xl font-bold mt-2">1</p>
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
                        <p class="text-3xl font-bold mt-2">5</p>
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
                        <p class="text-3xl font-bold mt-2">8</p>
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
                    <div class="w-1/3">
                        <input
                            id="searchInput"
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Cari berdasarkan deskripsi..."
                            type="text"
                        />
                    </div>
                    <select id="statusFilter" class="p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Status</option>
                        <option value="approved">Disetujui</option>
                        <option value="pending">Menunggu</option>
                        <option value="rejected">Ditolak</option>
                    </select>
                    <button id="filterBtn" class="btn-primary px-4 py-2 rounded-md">Terapkan Filter</button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-800">
                    <thead class="border-b border-gray-200 text-xs uppercase text-gray-500">
                        <tr>
                            <th class="py-3 px-4" scope="col">#</th>
                            <th class="py-3 px-4" scope="col">Driver</th>
                            <th class="py-3 px-4" scope="col">Jumlah</th>
                            <th class="py-3 px-4" scope="col">Status</th>
                            <th class="py-3 px-4" scope="col">Dibuat</th>
                            <th class="py-3 px-4" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="balanceTableBody">
                        <tr class="balance-row border-b border-gray-200">
                            <td class="py-4 px-4 font-medium text-gray-900">1</td>
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <img alt="test" class="w-8 h-8 rounded-full mr-3" src="https://picsum.photos/seed/driver1/40/40.jpg">
                                    <div>
                                        <div class="text-gray-900 font-medium">test</div>
                                        <div class="text-gray-500 text-xs">drivertest@gmail.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-gray-900">Rp 10.000</td>
                            <td class="py-4 px-4">
                                <span class="status-completed">DISETUJUI</span>
                            </td>
                            <td class="py-4 px-4 text-gray-900">1 Sep 2025</td>
                            <td class="py-4 px-4">
                                <div class="relative">
                                    <button class="text-gray-500 hover:text-gray-900 view-btn" data-id="1">
                                        <span class="material-icons-round text-base">visibility</span>
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
                            <td class="py-4 px-4 text-gray-900">Rp 25.000</td>
                            <td class="py-4 px-4">
                                <span class="status-pending">MENUNGGU</span>
                            </td>
                            <td class="py-4 px-4 text-gray-900">1 Sep 2025</td>
                            <td class="py-4 px-4">
                                <div class="relative">
                                    <button class="text-gray-500 hover:text-gray-900 view-btn" data-id="2">
                                        <span class="material-icons-round text-base">visibility</span>
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
                                        <div class="text-gray-500 text-xs">drivertest3@gmail.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-gray-900">Rp 5.000</td>
                            <td class="py-4 px-4">
                                <span class="status-cancelled">DITOLAK</span>
                            </td>
                            <td class="py-4 px-4 text-gray-900">1 Sep 2025</td>
                            <td class="py-4 px-4">
                                <div class="relative">
                                    <button class="text-gray-500 hover:text-gray-900 view-btn" data-id="3">
                                        <span class="material-icons-round text-base">visibility</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex justify-between items-center mt-4">
                <p class="text-sm text-gray-500">Menampilkan 1 hingga 3 dari 3 hasil</p>
                <div class="flex">
                    <button class="px-3 py-1 border rounded-l-md bg-white hover:bg-gray-100 transition-colors">Sebelumnya</button>
                    <button class="px-3 py-1 border-t border-b border-r rounded-r-md bg-white hover:bg-gray-100 transition-colors">Selanjutnya</button>
                </div>
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
<div id="detailModal" class="modal-overlay">
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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <p class="text-sm text-gray-500">ID Permintaan</p>
                    <p class="font-medium text-gray-800" id="modalRequestId">5fc9fa69-9977-45d6-a53d-416509e548b2</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Driver</p>
                    <p class="font-medium text-gray-800" id="modalDriverName">test</p>
                    <p class="text-sm text-gray-500" id="modalDriverEmail">drivertest@gmail.com</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Jumlah</p>
                    <p class="font-medium text-yellow-500 text-lg" id="modalAmount">Rp 10.000</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <span id="modalStatus" class="status-completed">DISETUJUI</span>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Dibuat</p>
                    <p class="font-medium text-gray-800" id="modalCreated">1 Sep 2025</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Terakhir Diperbarui</p>
                    <p class="font-medium text-gray-800" id="modalUpdated">1 Sep 2025</p>
                </div>
            </div>
            <div class="mb-6">
                <p class="text-sm text-gray-500 mb-2">Deskripsi</p>
                <div class="bg-gray-100 p-4 rounded-md">
                    <p class="text-gray-800" id="modalDescription">Test</p>
                </div>
            </div>
            <div class="mb-6">
                <p class="text-sm text-gray-500 mb-2">Bukti Pembayaran</p>
                <div class="bg-gray-100 p-4 rounded-md flex items-center justify-center">
                    <div class="relative">
                        <img alt="Payment proof document" class="w-24 h-32 object-cover rounded" src="https://picsum.photos/seed/paymentproof/200/300.jpg" />
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center rounded text-white opacity-0 hover:opacity-100 transition-opacity cursor-pointer">
                            <p class="text-sm">Lihat Ukuran Penuh</p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-2">Respons Admin</p>
                <div class="bg-gray-100 p-4 rounded-md">
                    <p class="font-medium text-gray-800" id="modalAdminResponse">Test Approve</p>
                    <p class="text-sm text-gray-500" id="modalAdminInfo">Ditinjau pada 1 Sep 2025 oleh System Administrator</p>
                </div>
            </div>
        </main>
        <div class="p-6 bg-gray-50 rounded-b-lg flex justify-between">
            <div id="actionButtons" class="space-x-2">
                <!-- Action buttons will be dynamically added based on status -->
            </div>
            <button id="closeModalBtn" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400 transition-colors">Tutup</button>
        </div>
    </div>
</div>

<!-- Notification Container -->
<div id="notification" class="notification"></div>

<script>
    // Sample data for balance requests
    const balanceRequests = [
        {
            id: 1,
            requestId: "5fc9fa69-9977-45d6-a53d-416509e548b2",
            driverName: "test",
            driverEmail: "drivertest@gmail.com",
            amount: "Rp 10.000",
            status: "approved",
            created: "1 Sep 2025",
            updated: "1 Sep 2025",
            description: "Test",
            adminResponse: "Test Approve",
            adminInfo: "Ditinjau pada 1 Sep 2025 oleh System Administrator"
        },
        {
            id: 2,
            requestId: "a7d8e9f0-1234-5678-9abc-def123456789",
            driverName: "test",
            driverEmail: "drivertest2@gmail.com",
            amount: "Rp 25.000",
            status: "pending",
            created: "1 Sep 2025",
            updated: "1 Sep 2025",
            description: "Test pending request",
            adminResponse: "",
            adminInfo: ""
        },
        {
            id: 3,
            requestId: "b2c3d4e5-6789-0abc-def1-234567890abc",
            driverName: "test",
            driverEmail: "drivertest3@gmail.com",
            amount: "Rp 5.000",
            status: "rejected",
            created: "1 Sep 2025",
            updated: "1 Sep 2025",
            description: "Test rejected request",
            adminResponse: "Test Reject",
            adminInfo: "Ditinjau pada 1 Sep 2025 oleh System Administrator"
        }
    ];

    // DOM elements
    const modal = document.getElementById('detailModal');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const closeModalIcon = document.getElementById('closeModal');
    const viewButtons = document.querySelectorAll('.view-btn');
    const filterBtn = document.getElementById('filterBtn');
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const notification = document.getElementById('notification');
    const actionButtons = document.getElementById('actionButtons');

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        // Add event listeners to view buttons
        viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                const requestId = parseInt(this.getAttribute('data-id'));
                openModal(requestId);
            });
        });

        // Close modal events
        closeModalBtn.addEventListener('click', closeModal);
        closeModalIcon.addEventListener('click', closeModal);

        // Close modal when clicking outside
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });

        // Filter button event
        filterBtn.addEventListener('click', applyFilters);

        // Search input event
        searchInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                applyFilters();
            }
        });
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

    // Open modal with request details
    function openModal(requestId) {
        const request = balanceRequests.find(req => req.id === requestId);
        if (!request) return;

        // Populate modal with request data
        document.getElementById('modalRequestId').textContent = request.requestId;
        document.getElementById('modalDriverName').textContent = request.driverName;
        document.getElementById('modalDriverEmail').textContent = request.driverEmail;
        document.getElementById('modalAmount').textContent = request.amount;
        document.getElementById('modalCreated').textContent = request.created;
        document.getElementById('modalUpdated').textContent = request.updated;
        document.getElementById('modalDescription').textContent = request.description;
        document.getElementById('modalAdminResponse').textContent = request.adminResponse || "Belum ada respons";
        document.getElementById('modalAdminInfo').textContent = request.adminInfo || "Belum ditinjau";

        // Set status badge
        const statusElement = document.getElementById('modalStatus');
        statusElement.textContent = request.status === 'approved' ? 'DISETUJUI' :
                                   request.status === 'pending' ? 'MENUNGGU' : 'DITOLAK';
        statusElement.className = 'text-xs font-medium px-2.5 py-0.5 rounded-full';

        if (request.status === 'approved') {
            statusElement.classList.add('status-completed');
        } else if (request.status === 'pending') {
            statusElement.classList.add('status-pending');
        } else if (request.status === 'rejected') {
            statusElement.classList.add('status-cancelled');
        }

        // Set action buttons based on status
        actionButtons.innerHTML = '';
        if (request.status === 'pending') {
            const approveBtn = document.createElement('button');
            approveBtn.className = 'bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition-colors';
            approveBtn.textContent = 'Setujui';
            approveBtn.addEventListener('click', () => updateRequestStatus(requestId, 'approved'));

            const rejectBtn = document.createElement('button');
            rejectBtn.className = 'bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition-colors';
            rejectBtn.textContent = 'Tolak';
            rejectBtn.addEventListener('click', () => updateRequestStatus(requestId, 'rejected'));

            actionButtons.appendChild(approveBtn);
            actionButtons.appendChild(rejectBtn);
        }

        // Show modal
        modal.classList.add('active');
    }

    // Close modal
    function closeModal() {
        modal.classList.remove('active');
    }

    // Update request status
    function updateRequestStatus(requestId, newStatus) {
        const request = balanceRequests.find(req => req.id === requestId);
        if (!request) return;

        // Update status in data
        request.status = newStatus;
        request.updated = new Date().toLocaleDateString('id-ID', { year: 'numeric', month: 'short', day: 'numeric' });

        if (newStatus === 'approved') {
            request.adminResponse = "Permintaan disetujui oleh System Administrator";
        } else if (newStatus === 'rejected') {
            request.adminResponse = "Permintaan ditolak oleh System Administrator";
        }

        request.adminInfo = `Ditinjau pada ${request.updated} oleh System Administrator`;

        // Update table
        updateTable();

        // Close modal
        closeModal();

        // Show notification
        showNotification(`Permintaan berhasil ${newStatus === 'approved' ? 'disetujui' : 'ditolak'}`, 'success');
    }

    // Apply filters
    function applyFilters() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;

        const filteredRequests = balanceRequests.filter(request => {
            const matchesSearch = request.description.toLowerCase().includes(searchTerm) ||
                                 request.driverName.toLowerCase().includes(searchTerm) ||
                                 request.driverEmail.toLowerCase().includes(searchTerm);

            const matchesStatus = !statusValue || request.status === statusValue;

            return matchesSearch && matchesStatus;
        });

        updateTable(filteredRequests);

        if (filteredRequests.length === 0) {
            showNotification('Tidak ada permintaan yang cocok dengan kriteria Anda', 'info');
        } else {
            showNotification(`Ditemukan ${filteredRequests.length} permintaan`, 'info');
        }
    }

    // Update table with filtered data
    function updateTable(data = balanceRequests) {
        const tableBody = document.getElementById('balanceTableBody');
        tableBody.innerHTML = '';

        data.forEach(request => {
            const row = document.createElement('tr');
            row.className = 'balance-row border-b border-gray-200';

            let statusBadge = '';
            if (request.status === 'approved') {
                statusBadge = '<span class="status-completed">DISETUJUI</span>';
            } else if (request.status === 'pending') {
                statusBadge = '<span class="status-pending">MENUNGGU</span>';
            } else if (request.status === 'rejected') {
                statusBadge = '<span class="status-cancelled">DITOLAK</span>';
            }

            row.innerHTML = `
                <td class="py-4 px-4 font-medium text-gray-900">${request.id}</td>
                <td class="py-4 px-4">
                    <div class="flex items-center">
                        <img alt="${request.driverName}" class="w-8 h-8 rounded-full mr-3" src="https://picsum.photos/seed/driver${request.id}/40/40.jpg">
                        <div>
                            <div class="text-gray-900 font-medium">${request.driverName}</div>
                            <div class="text-gray-500 text-xs">${request.driverEmail}</div>
                        </div>
                    </div>
                </td>
                <td class="py-4 px-4 text-gray-900">${request.amount}</td>
                <td class="py-4 px-4">${statusBadge}</td>
                <td class="py-4 px-4 text-gray-900">${request.created}</td>
                <td class="py-4 px-4">
                    <div class="relative">
                        <button class="text-gray-500 hover:text-gray-900 view-btn" data-id="${request.id}">
                            <span class="material-icons-round text-base">visibility</span>
                        </button>
                    </div>
                </td>
            `;

            tableBody.appendChild(row);
        });

        // Re-attach event listeners to new view buttons
        document.querySelectorAll('.view-btn').forEach(button => {
            button.addEventListener('click', function() {
                const requestId = parseInt(this.getAttribute('data-id'));
                openModal(requestId);
            });
        });

        // Update pagination info
        document.querySelector('.text-sm.text-gray-500').textContent = `Menampilkan 1 hingga ${data.length} dari ${data.length} hasil`;
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
</script>
</body>
</html>
