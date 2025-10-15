<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Pendaftaran Driver</title>
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

        .status-approved {
            background: linear-gradient(135deg, #10B981, #059669);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            box-shadow: 0 2px 10px rgba(16, 185, 129, 0.3);
        }

        .status-pending {
            background: linear-gradient(135deg, #F59E0B, #D97706);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            box-shadow: 0 2px 10px rgba(245, 158, 11, 0.3);
        }

        .status-rejected {
            background: linear-gradient(135deg, #EF4444, #DC2626);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            box-shadow: 0 2px 10px rgba(239, 68, 68, 0.3);
        }

        .doc-link {
            color: var(--primary);
            font-weight: 500;
            display: inline-block;
            padding: 4px 8px;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .doc-link:hover {
            background-color: rgba(99, 102, 241, 0.1);
            transform: translateY(-2px);
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

        /* Modal Styles */
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
            max-width: 900px;
            width: 100%;
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

        .document-preview {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 150px;
            transition: all 0.3s ease;
        }

        .document-preview:hover {
            background: #f0f2f5;
            transform: scale(1.02);
        }

        .action-button {
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .accept-button {
            background: linear-gradient(135deg, #10B981, #059669);
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .accept-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        .reject-button {
            background: linear-gradient(135deg, #EF4444, #DC2626);
            color: white;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .reject-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
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

        .admin-response {
            background: linear-gradient(135deg, #1e293b, #334155);
            color: white;
            border-radius: 12px;
            padding: 15px;
            margin-top: 20px;
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

            .modal-content {
                margin: 10px;
                max-height: calc(100vh - 20px);
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
            <a class="flex items-center p-3 rounded-lg nav-item" href="#">
                <span class="material-icons-round mr-4">directions_car</span>
                <span class="sidebar-text">Kendaraan</span>
            </a>
            <a class="flex items-center p-3 rounded-lg nav-item" href="#">
                <span class="material-icons-round mr-4">account_balance_wallet</span>
                <span class="sidebar-text">Saldo</span>
            </a>
            <a class="flex items-center p-3 rounded-lg nav-item active" href="#">
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
                <h2 class="text-2xl font-bold text-white">Pendaftaran Driver</h2>
                <p class="text-white/80 text-sm">Kelola permintaan pendaftaran driver dan persetujuan</p>
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
                </button>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <div class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
            <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Total Permintaan</p>
                        <p class="text-3xl font-bold mt-2">3</p>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">assignment</span>
                    </div>
                </div>
            </div>

            <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Diajukan</p>
                        <p class="text-3xl font-bold mt-2">0</p>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">pending_actions</span>
                    </div>
                </div>
            </div>

            <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Menunggu</p>
                        <p class="text-3xl font-bold mt-2">1</p>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">hourglass_empty</span>
                    </div>
                </div>
            </div>

            <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Disetujui</p>
                        <p class="text-3xl font-bold mt-2">1</p>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">check_circle</span>
                    </div>
                </div>
            </div>

            <div class="stat-card card p-6 text-white" style="background: linear-gradient(135deg, #f43b47 0%, #453a94 100%);">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Ditolak</p>
                        <p class="text-3xl font-bold mt-2">1</p>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">cancel</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="card p-6 mb-6">
            <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                <div class="flex-1 relative w-full">
                    <span class="material-icons-round absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                    <input class="search-input w-full pl-10 pr-4 py-2 text-gray-800" placeholder="Cari berdasarkan nama atau email driver..." type="text"/>
                </div>
                <div class="relative w-full md:w-auto">
                    <select class="bg-white border border-gray-300 rounded-lg py-2 pl-3 pr-8 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800 w-full md:w-auto">
                        <option>Semua Status</option>
                        <option>Disetujui</option>
                        <option>Menunggu</option>
                        <option>Ditolak</option>
                    </select>
                    <span class="material-icons-round absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">expand_more</span>
                </div>
                <button class="btn-primary px-6 py-2 font-medium w-full md:w-auto">Terapkan Filter</button>
            </div>
        </div>

        <!-- Driver Registration Table -->
        <div class="card p-6">
            <h3 class="text-lg font-semibold mb-4 text-gray-800">Permintaan Pendaftaran Driver</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gradient-to-r from-blue-50 to-indigo-50 text-gray-700">
                        <tr>
                            <th class="p-3 font-semibold">#</th>
                            <th class="p-3 font-semibold">Driver</th>
                            <th class="p-3 font-semibold">Kendaraan</th>
                            <th class="p-3 font-semibold">Dokumen</th>
                            <th class="p-3 font-semibold">Status</th>
                            <th class="p-3 font-semibold">Diajukan</th>
                            <th class="p-3 font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-row border-b border-gray-100">
                            <td class="p-3 text-orange-500 font-bold">1</td>
                            <td class="p-3">
                                <div class="flex items-center">
                                    <img src="https://picsum.photos/seed/driver1/40/40.jpg" alt="Driver" class="w-10 h-10 rounded-full mr-3">
                                    <div>
                                        <div class="font-semibold text-gray-800">test</div>
                                        <div class="text-sm text-gray-500">drivertes123@gmail.com</div>
                                        <div class="text-sm text-gray-500">+1287128</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3">
                                <div class="font-semibold text-gray-800">Honda Beat 2020</div>
                                <div class="text-sm text-gray-500">MOTORCYCLE - B1234ABCA123asd</div>
                            </td>
                            <td class="p-3 space-x-2">
                                <a class="doc-link" href="#">ID</a>
                                <a class="doc-link" href="#">SIM</a>
                                <a class="doc-link" href="#">REG</a>
                                <a class="doc-link" href="#">PAY</a>
                            </td>
                            <td class="p-3"><span class="status-approved">DISETUJUI</span></td>
                            <td class="p-3 text-gray-600">1 Sep 2025</td>
                            <td class="p-3">
                                <div class="flex space-x-2">
                                    <button class="text-gray-500 hover:text-blue-600 p-1 rounded-full hover:bg-blue-50" onclick="openModal('test')">
                                        <span class="material-icons-round">visibility</span>
                                    </button>
                                    <button class="text-red-500 hover:text-red-600 p-1 rounded-full hover:bg-red-50">
                                        <span class="material-icons-round">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-row border-b border-gray-100">
                            <td class="p-3 text-yellow-500 font-bold">2</td>
                            <td class="p-3">
                                <div class="flex items-center">
                                    <img src="https://picsum.photos/seed/driver2/40/40.jpg" alt="Driver" class="w-10 h-10 rounded-full mr-3">
                                    <div>
                                        <div class="font-semibold text-gray-800">budi</div>
                                        <div class="text-sm text-gray-500">budi@gmail.com</div>
                                        <div class="text-sm text-gray-500">+628123456789</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3">
                                <div class="font-semibold text-gray-800">Yamaha Mio</div>
                                <div class="text-sm text-gray-500">MOTORCYCLE - B5678XYZ</div>
                            </td>
                            <td class="p-3 space-x-2">
                                <a class="doc-link" href="#">ID</a>
                                <a class="doc-link" href="#">SIM</a>
                                <a class="doc-link" href="#">REG</a>
                                <a class="doc-link" href="#">PAY</a>
                            </td>
                            <td class="p-3"><span class="status-pending">MENUNGGU</span></td>
                            <td class="p-3 text-gray-600">2 Sep 2025</td>
                            <td class="p-3">
                                <div class="flex space-x-2">
                                    <button class="text-gray-500 hover:text-blue-600 p-1 rounded-full hover:bg-blue-50" onclick="openModal('budi')">
                                        <span class="material-icons-round">visibility</span>
                                    </button>
                                    <button class="text-red-500 hover:text-red-600 p-1 rounded-full hover:bg-red-50">
                                        <span class="material-icons-round">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-row">
                            <td class="p-3 text-red-500 font-bold">3</td>
                            <td class="p-3">
                                <div class="flex items-center">
                                    <img src="https://picsum.photos/seed/driver3/40/40.jpg" alt="Driver" class="w-10 h-10 rounded-full mr-3">
                                    <div>
                                        <div class="font-semibold text-gray-800">sari</div>
                                        <div class="text-sm text-gray-500">sari@gmail.com</div>
                                        <div class="text-sm text-gray-500">+628987654321</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-3">
                                <div class="font-semibold text-gray-800">Suzuki Spin</div>
                                <div class="text-sm text-gray-500">MOTORCYCLE - B4321ZYX</div>
                            </td>
                            <td class="p-3 space-x-2">
                                <a class="doc-link" href="#">ID</a>
                                <a class="doc-link" href="#">SIM</a>
                                <a class="doc-link" href="#">REG</a>
                                <a class="doc-link" href="#">PAY</a>
                            </td>
                            <td class="p-3"><span class="status-rejected">DITOLAK</span></td>
                            <td class="p-3 text-gray-600">3 Sep 2025</td>
                            <td class="p-3">
                                <div class="flex space-x-2">
                                    <button class="text-gray-500 hover:text-blue-600 p-1 rounded-full hover:bg-blue-50" onclick="openModal('sari')">
                                        <span class="material-icons-round">visibility</span>
                                    </button>
                                    <button class="text-red-500 hover:text-red-600 p-1 rounded-full hover:bg-red-50">
                                        <span class="material-icons-round">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex justify-between items-center mt-6 text-sm text-gray-500">
                <p>Menampilkan 1 hingga 3 dari 3 hasil</p>
                <div class="flex items-center space-x-2">
                    <button class="px-3 py-1 rounded-lg bg-gray-100 hover:bg-gray-200 disabled:bg-gray-50 disabled:text-gray-300" disabled>
                        <span class="material-icons-round text-sm">chevron_left</span>
                    </button>
                    <button class="px-3 py-1 rounded-lg bg-gray-100 hover:bg-gray-200">
                        <span class="material-icons-round text-sm">chevron_right</span>
                    </button>
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

<!-- Driver Detail Modal -->
<div class="modal-overlay" id="driverModal">
    <div class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full px-8 py-10" style="max-height:90vh; overflow-y:auto;">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Detail Pendaftaran Driver</h2>
            <button class="modal-close" onclick="closeModal()">
                <span class="material-icons-round">close</span>
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-4 mb-6">
            <div class="space-y-2">
                <p class="text-xs text-gray-500">ID Pendaftaran</p>
                <p class="font-semibold text-gray-900 break-all">05dc89b5-bd7f-45ae-8a8f-9ef2312ca82</p>
            </div>
            <div class="space-y-1">
                <p class="text-xs text-gray-500">Driver</p>
                <p class="font-semibold text-gray-900" id="modalDriverName">test</p>
                <p class="text-xs text-gray-500" id="modalDriverEmail">drivertest2@gmail.com</p>
                <p class="text-xs text-gray-500" id="modalDriverPhone">+6281338</p>
            </div>
            <div class="space-y-2">
                <p class="text-xs text-gray-500">Nama Kendaraan</p>
                <p class="font-semibold text-gray-900" id="modalVehicleName">Honda Beat 2020</p>
            </div>
            <div class="space-y-2">
                <p class="text-xs text-gray-500">Tipe Kendaraan</p>
                <p class="font-semibold text-gray-900" id="modalVehicleType">MOTORCYCLE</p>
            </div>
            <div class="space-y-2">
                <p class="text-xs text-gray-500">Plat Kendaraan</p>
                <p class="font-semibold text-gray-900" id="modalVehiclePlate">B1234ABCA123asd</p>
            </div>
            <div class="space-y-2">
                <p class="text-xs text-gray-500">Status</p>
                <span class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full" id="modalStatus">APPROVED</span>
            </div>
            <div class="space-y-2">
                <p class="text-xs text-gray-500">Tanggal Diajukan</p>
                <p class="font-semibold text-gray-900">1 Sep 2025</p>
            </div>
            <div class="space-y-2">
                <p class="text-xs text-gray-500">Terakhir Diperbarui</p>
                <p class="font-semibold text-gray-900">1 Sep 2025</p>
            </div>
        </div>

        <h3 class="text-lg font-bold mt-6 mb-3">Dokumen</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-2 mb-4">
            <div class="space-y-2">
                <p class="text-xs text-gray-500">Nomor ID Utama</p>
                <p class="font-semibold text-gray-900">123456</p>
            </div>
            <div class="space-y-2">
                <p class="text-xs text-gray-500 mb-1">Gambar ID Utama</p>
                <div class="bg-gray-100 p-4 rounded-lg flex items-center justify-center min-h-[120px]">
                    <span class="material-symbols-outlined text-5xl text-gray-300">image</span>
                </div>
            </div>
            <div class="space-y-2">
                <p class="text-xs text-gray-500">Nomor SIM</p>
                <p class="font-semibold text-gray-900">987654321</p>
            </div>
            <div class="space-y-2">
                <p class="text-xs text-gray-500 mb-1">Gambar SIM</p>
                <div class="bg-gray-100 p-4 rounded-lg flex items-center justify-center min-h-[120px]">
                    <span class="material-symbols-outlined text-5xl text-gray-300">image</span>
                </div>
            </div>
            <div class="space-y-2">
                <p class="text-xs text-gray-500">Nomor Registrasi Kendaraan</p>
                <p class="font-semibold text-gray-900">B1234XYZ</p>
            </div>
            <div class="space-y-2">
                <p class="text-xs text-gray-500 mb-1">Gambar Registrasi Kendaraan</p>
                <div class="bg-gray-100 p-4 rounded-lg flex items-center justify-center min-h-[120px]">
                    <span class="material-symbols-outlined text-5xl text-gray-300">image</span>
                </div>
            </div>
        </div>

        <h3 class="text-lg font-bold mt-8 mb-3">Lampiran Foto</h3>
        <div class="flex flex-col items-center md:items-start gap-4 mb-4">
            <span class="text-sm text-gray-500 mb-2">Bukti Pembayaran</span>
            <div class="bg-gray-100 p-4 rounded-lg flex items-center justify-center min-h-[120px] w-full max-w-xs md:max-w-sm">
                <span class="material-symbols-outlined text-5xl text-gray-300">image</span>
            </div>
            <div class="w-full max-w-xs md:max-w-sm mt-4">
                <span class="text-sm text-gray-500 mb-2 block">Respon Admin</span>
                <div class="bg-gray-900 text-white rounded-lg w-full p-4 mb-4">
                    <div class="text-base font-semibold mb-1">test</div>
                    <div class="text-xs text-gray-400">Ditinjau pada 1 Sep 2025</div>
                </div>
                <div class="flex gap-3 justify-center">
                    <button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-lg shadow transition">Terima</button>
                    <button class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-6 rounded-lg shadow transition">Tolak</button>
                </div>
            </div>
        </div>
    </div>
</div>

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
            <a class="flex items-center p-3 rounded-lg nav-item active" href="#">
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

    // Modal functions
    function openModal(driverName) {
        const modal = document.getElementById('driverModal');
        const modalDriverName = document.getElementById('modalDriverName');
        const modalDriverEmail = document.getElementById('modalDriverEmail');
        const modalDriverPhone = document.getElementById('modalDriverPhone');
        const modalStatus = document.getElementById('modalStatus');
        const modalVehicleName = document.getElementById('modalVehicleName');
        const modalVehicleType = document.getElementById('modalVehicleType');
        const modalVehiclePlate = document.getElementById('modalVehiclePlate');

        // Update modal content based on driver
        if (driverName === 'test') {
            modalDriverName.textContent = 'test';
            modalDriverEmail.textContent = 'drivertes123@gmail.com';
            modalDriverPhone.textContent = '+1287128';
            modalStatus.textContent = 'APPROVED';
            modalStatus.className = 'bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full';
            modalVehicleName.textContent = 'Honda Beat 2020';
            modalVehicleType.textContent = 'MOTORCYCLE';
            modalVehiclePlate.textContent = 'B1234ABCA123asd';
        } else if (driverName === 'budi') {
            modalDriverName.textContent = 'budi';
            modalDriverEmail.textContent = 'budi@gmail.com';
            modalDriverPhone.textContent = '+628123456789';
            modalStatus.textContent = 'PENDING';
            modalStatus.className = 'bg-yellow-100 text-yellow-800 text-xs font-bold px-3 py-1 rounded-full';
            modalVehicleName.textContent = 'Yamaha Mio';
            modalVehicleType.textContent = 'MOTORCYCLE';
            modalVehiclePlate.textContent = 'B5678XYZ';
        } else if (driverName === 'sari') {
            modalDriverName.textContent = 'sari';
            modalDriverEmail.textContent = 'sari@gmail.com';
            modalDriverPhone.textContent = '+628987654321';
            modalStatus.textContent = 'REJECTED';
            modalStatus.className = 'bg-red-100 text-red-800 text-xs font-bold px-3 py-1 rounded-full';
            modalVehicleName.textContent = 'Suzuki Spin';
            modalVehicleType.textContent = 'MOTORCYCLE';
            modalVehiclePlate.textContent = 'B4321ZYX';
        }

        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        const modal = document.getElementById('driverModal');
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    document.getElementById('driverModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>
</body>
</html>
