<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>TaksiKu - Manajemen Pengguna</title>
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

        .user-row {
            transition: all 0.2s ease;
        }

        .user-row:hover {
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
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .role-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .role-driver {
            background-color: rgba(59, 130, 246, 0.15);
            color: #3B82F6;
        }

        .role-admin {
            background-color: rgba(239, 68, 68, 0.15);
            color: #EF4444;
        }

        .role-user {
            background-color: rgba(16, 185, 129, 0.15);
            color: #10B981;
        }

        .status-badge {
            display: flex;
            align-items: center;
            font-size: 14px;
        }

        .status-online {
            color: var(--success);
        }

        .status-offline {
            color: var(--danger);
        }

        .status-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 8px;
        }

        .status-online .status-indicator {
            background-color: var(--success);
            animation: blink 2s infinite;
        }

        .status-offline .status-indicator {
            background-color: var(--danger);
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .verified-badge {
            display: flex;
            align-items: center;
            color: var(--success);
            font-size: 14px;
        }

        .verified-badge .material-icons-round {
            font-size: 16px;
            margin-right: 4px;
        }

        .user-avatar-gold {
            background: linear-gradient(135deg, #F59E0B, #F97316);
        }

        .user-avatar-red {
            background: linear-gradient(135deg, #EF4444, #DC2626);
        }

        .user-avatar-blue {
            background: linear-gradient(135deg, #3B82F6, #2563EB);
        }

        .user-avatar-purple {
            background: linear-gradient(135deg, #8B5CF6, #7C3AED);
        }

        .user-avatar-green {
            background: linear-gradient(135deg, #10B981, #059669);
        }

        .user-avatar-teal {
            background: linear-gradient(135deg, #14B8A6, #0D9488);
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

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 50;
            display: none;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
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

        .form-input {
            background-color: #f1f5f9;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 12px 16px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
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
            <a class="flex items-center p-3 rounded-lg nav-item active" href="#">
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
                <img src="https://picsum.photos/seed/admin/40/40.jpg" alt="Admin" class="w-10 h-10 rounded-full mr-3">
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
                <h2 class="text-2xl font-bold text-white">Manajemen Pengguna</h2>
                <p class="text-white/80 text-sm">Kelola semua pengguna yang terdaftar dalam sistem</p>
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

            <button id="createUserBtn" class="btn-primary px-4 py-2 font-medium flex items-center">
                <span class="material-icons-round text-sm mr-1">add</span>
                Buat Pengguna
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
                        <p class="text-sm opacity-80">Total Pengguna</p>
                        <p class="text-3xl font-bold mt-2">22</p>
                        <div class="flex items-center mt-3">
                            <span class="material-icons-round text-xs">groups</span>
                            <span class="text-xs ml-1">Semua pengguna terdaftar</span>
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">groups</span>
                    </div>
                </div>
            </div>

            <div class="card p-6 text-white" style="background: linear-gradient(135deg, #10B981 0%, #14B8A6 100%);">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Pengguna Aktif</p>
                        <p class="text-3xl font-bold mt-2">13</p>
                        <div class="flex items-center mt-3">
                            <span class="material-icons-round text-xs">check_circle</span>
                            <span class="text-xs ml-1">Sedang online</span>
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">check_circle</span>
                    </div>
                </div>
            </div>

            <div class="card p-6 text-white" style="background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Driver</p>
                        <p class="text-3xl font-bold mt-2">0</p>
                        <div class="flex items-center mt-3">
                            <span class="material-icons-round text-xs">drive_eta</span>
                            <span class="text-xs ml-1">Driver terdaftar</span>
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">drive_eta</span>
                    </div>
                </div>
            </div>

            <div class="card p-6 text-white" style="background: linear-gradient(135deg, #F59E0B 0%, #F97316 100%);">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Pengguna Baru</p>
                        <p class="text-3xl font-bold mt-2">20</p>
                        <div class="flex items-center mt-3">
                            <span class="material-icons-round text-xs">person_add</span>
                            <span class="text-xs ml-1">Bulan ini</span>
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">person_add</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="card p-4 mb-6">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="relative flex-1">
                    <span class="material-icons-round absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                    <input class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari berdasarkan nama atau email..." type="text" />
                </div>
                <div class="relative">
                    <select class="w-48 appearance-none bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option>Semua Status</option>
                        <option>Online</option>
                        <option>Offline</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <span class="material-icons-round text-sm">expand_more</span>
                    </div>
                </div>
                <div class="relative">
                    <select class="w-48 appearance-none bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option>Semua Peran</option>
                        <option>Admin</option>
                        <option>Driver</option>
                        <option>User</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <span class="material-icons-round text-sm">expand_more</span>
                    </div>
                </div>
                <button class="px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 transition-colors">
                    <span class="material-icons-round text-sm mr-1">refresh</span>
                    Refresh
                </button>
            </div>
        </div>

        <!-- Users Table -->
        <div class="card overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-xl font-semibold text-gray-800">Daftar Pengguna</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700">#</th>
                            <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700">Pengguna</th>
                            <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700">Peran</th>
                            <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700">Telepon</th>
                            <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700">Terverifikasi</th>
                            <th class="py-3 px-6 text-left text-sm font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <tr class="user-row border-b border-gray-200">
                            <td class="py-4 px-6">1</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="user-avatar user-avatar-gold mr-3">T</div>
                                    <div>
                                        <p class="font-medium">Driver</p>
                                        <p class="text-sm text-gray-500">driver@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6"><span class="role-badge role-driver">Driver</span></td>
                            <td class="py-4 px-6">081556216168</td>
                            <td class="py-4 px-6">
                                <div class="status-badge status-offline">
                                    <span class="status-indicator"></span>
                                    Offline
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="verified-badge">
                                    <span class="material-icons-round">check_circle</span>
                                    Terverifikasi
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <button class="text-blue-600 hover:text-blue-800 font-medium">Lihat</button>
                            </td>
                        </tr>
                        <tr class="user-row border-b border-gray-200">
                            <td class="py-4 px-6">2</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="user-avatar user-avatar-red mr-3">A</div>
                                    <div>
                                        <p class="font-medium">Admin</p>
                                        <p class="text-sm text-gray-500">admin@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6"><span class="role-badge role-admin">Admin</span></td>
                            <td class="py-4 px-6">08810982729</td>
                            <td class="py-4 px-6">
                                <div class="status-badge status-offline">
                                    <span class="status-indicator"></span>
                                    Offline
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="verified-badge">
                                    <span class="material-icons-round">check_circle</span>
                                    Terverifikasi
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <button class="text-blue-600 hover:text-blue-800 font-medium">Lihat</button>
                            </td>
                        </tr>
                        <tr class="user-row border-b border-gray-200">
                            <td class="py-4 px-6">3</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="user-avatar user-avatar-blue mr-3">E</div>
                                    <div>
                                        <p class="font-medium">User</p>
                                        <p class="text-sm text-gray-500">user@gmail.com</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6"><span class="role-badge role-user">User</span></td>
                            <td class="py-4 px-6">08548636302</td>
                            <td class="py-4 px-6">
                                <div class="status-badge status-offline">
                                    <span class="status-indicator"></span>
                                    Offline
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="verified-badge">
                                    <span class="material-icons-round">check_circle</span>
                                    Terverifikasi
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <button class="text-blue-600 hover:text-blue-800 font-medium">Lihat</button>
                            </td>
                        </tr>
                        <tr class="user-row border-b border-gray-200">
                            <td class="py-4 px-6">4</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="user-avatar user-avatar-purple mr-3">J</div>
                                    <div>
                                        <p class="font-medium">John Doe</p>
                                        <p class="text-sm text-gray-500">john.doe@example.com</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6"><span class="role-badge role-user">User</span></td>
                            <td class="py-4 px-6">08123456789</td>
                            <td class="py-4 px-6">
                                <div class="status-badge status-online">
                                    <span class="status-indicator"></span>
                                    Online
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="verified-badge">
                                    <span class="material-icons-round">check_circle</span>
                                    Terverifikasi
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <button class="text-blue-600 hover:text-blue-800 font-medium">Lihat</button>
                            </td>
                        </tr>
                        <tr class="user-row">
                            <td class="py-4 px-6">5</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="user-avatar user-avatar-green mr-3">S</div>
                                    <div>
                                        <p class="font-medium">Sarah Smith</p>
                                        <p class="text-sm text-gray-500">sarah.smith@example.com</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6"><span class="role-badge role-driver">Driver</span></td>
                            <td class="py-4 px-6">08234567890</td>
                            <td class="py-4 px-6">
                                <div class="status-badge status-online">
                                    <span class="status-indicator"></span>
                                    Online
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="verified-badge">
                                    <span class="material-icons-round">check_circle</span>
                                    Terverifikasi
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <button class="text-blue-600 hover:text-blue-800 font-medium">Lihat</button>
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
            <a class="flex items-center p-3 rounded-lg nav-item active" href="#">
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

<!-- Create User Modal -->
<div id="createUserModal" class="modal-overlay">
    <div class="modal-content">
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-2xl font-bold text-gray-800">Buat Pengguna Baru</h3>
                <button id="closeModalBtn" class="text-gray-500 hover:text-gray-700">
                    <span class="material-icons-round">close</span>
                </button>
            </div>
        </div>
        <form id="createUserForm" class="p-6">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2" for="full_name">Nama Lengkap</label>
                <input class="form-input" id="full_name" placeholder="Masukkan nama lengkap" type="text"/>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2" for="email">Alamat Email</label>
                <input class="form-input" id="email" placeholder="Masukkan alamat email" type="email"/>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2" for="password">Kata Sandi</label>
                <input class="form-input" id="password" placeholder="Masukkan kata sandi kuat (min 8 karakter)" type="password"/>
                <p class="text-xs text-gray-500 mt-1">Harus mengandung setidaknya 8 karakter dengan huruf besar, huruf kecil, dan angka</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2" for="phone">Nomor Telepon</label>
                <input class="form-input" id="phone" placeholder="08123456789" type="tel"/>
                <p class="text-xs text-gray-500 mt-1">Hanya angka, minimal 10 digit (contoh: 08123456789)</p>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2" for="role">Peran</label>
                <div class="relative">
                    <select class="form-input appearance-none" id="role">
                        <option>Pilih peran pengguna</option>
                        <option>Admin</option>
                        <option>Driver</option>
                        <option>User</option>
                    </select>
                    <span class="material-icons-round absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">arrow_drop_down</span>
                </div>
            </div>
            <div class="flex justify-end space-x-4">
                <button id="cancelBtn" type="button" class="px-6 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 font-semibold">Batal</button>
                <button type="submit" class="btn-primary text-white font-bold py-2 px-6 rounded-lg">Buat Pengguna</button>
            </div>
        </form>
    </div>
</div>

<!-- Notification Container -->
<div id="notification" class="notification"></div>

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

    // Show notification
    function showNotification(message, type = 'info') {
        const notification = document.getElementById('notification');
        notification.textContent = message;
        notification.className = `notification ${type}`;
        notification.classList.add('show');

        setTimeout(() => {
            notification.classList.remove('show');
        }, 3000);
    }

    // Modal functionality
    const createUserBtn = document.getElementById('createUserBtn');
    const createUserModal = document.getElementById('createUserModal');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const createUserForm = document.getElementById('createUserForm');

    // Open modal
    createUserBtn.addEventListener('click', () => {
        createUserModal.classList.add('active');
    });

    // Close modal functions
    function closeModal() {
        createUserModal.classList.remove('active');
        createUserForm.reset();
    }

    closeModalBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);

    // Close modal when clicking outside
    createUserModal.addEventListener('click', (event) => {
        if (event.target === createUserModal) {
            closeModal();
        }
    });

    // Handle form submission
    createUserForm.addEventListener('submit', (e) => {
        e.preventDefault();

        // Get form values
        const fullName = document.getElementById('full_name').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const phone = document.getElementById('phone').value;
        const role = document.getElementById('role').value;

        // Validate form
        if (!fullName || !email || !password || !phone || role === 'Pilih peran pengguna') {
            showNotification('Mohon lengkapi semua field', 'error');
            return;
        }

        // Validate password
        if (password.length < 8) {
            showNotification('Kata sandi harus memiliki minimal 8 karakter', 'error');
            return;
        }

        // Validate phone
        if (!/^\d{10,}$/.test(phone)) {
            showNotification('Nomor telepon harus berupa angka dengan minimal 10 digit', 'error');
            return;
        }

        // In a real application, you would send this data to your server
        console.log('Creating user:', { fullName, email, password, phone, role });

        // Show success message
        showNotification('Pengguna berhasil dibuat', 'success');

        // Close modal
        closeModal();

        // In a real application, you would refresh the user list or add the new user to the table
        // For demo purposes, we'll just show a message
        setTimeout(() => {
            showNotification('Pengguna baru telah ditambahkan ke daftar', 'info');
        }, 1000);
    });

    // Add event listeners to view buttons
    document.addEventListener('DOMContentLoaded', function() {
        const viewButtons = document.querySelectorAll('button.text-blue-600');
        viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                showNotification('Membuka detail pengguna', 'info');
            });
        });
    });
</script>
</body>
</html>
