<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Manajemen Umpan Balik - TaksiKu</title>
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

        .view-button {
            color: var(--primary);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .view-button:hover {
            background-color: rgba(99, 102, 241, 0.1);
            transform: translateY(-2px);
        }

        .feedback-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .feedback-admin {
            background: linear-gradient(135deg, #3B82F6, #2563EB);
            color: white;
            box-shadow: 0 2px 10px rgba(59, 130, 246, 0.3);
        }

        .feedback-driver {
            background: linear-gradient(135deg, #10B981, #059669);
            color: white;
            box-shadow: 0 2px 10px rgba(16, 185, 129, 0.3);
        }

        .user-avatar-small {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            font-size: 14px;
        }

        .avatar-driver {
            background: linear-gradient(135deg, #10B981, #059669);
        }

        .avatar-user {
            background: linear-gradient(135deg, #EF4444, #DC2626);
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
            <a class="flex items-center p-3 rounded-lg nav-item active" href="#">
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
                <h2 class="text-2xl font-bold text-white">Manajemen Umpan Balik</h2>
                <p class="text-white/80 text-sm">Kelola dan tanggapi umpan balik dari pengguna</p>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            <div class="relative">
                <input type="text" placeholder="Cari..." class="bg-white/90 backdrop-filter backdrop-blur-lg border border-white/30 rounded-full px-4 py-2 pr-10 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <span class="material-icons-round absolute right-3 top-2.5 text-gray-500">search</span>
            </div>

            <div class="relative">
                <button class="text-white hover:text-white/80 p-2 rounded-full hover:bg-white/20">
                    <span class="material-icons-round">notifications</span>
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <div class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="card p-6 text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Total Umpan Balik</p>
                        <p class="text-3xl font-bold mt-2">12</p>
                        <div class="flex items-center mt-3">
                            <span class="material-icons-round text-xs">trending_up</span>
                            <span class="text-xs ml-1">8% dari minggu lalu</span>
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">feedback</span>
                    </div>
                </div>
            </div>

            <div class="card p-6 text-white" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Menunggu Tanggapan</p>
                        <p class="text-3xl font-bold mt-2">5</p>
                        <div class="flex items-center mt-3">
                            <span class="material-icons-round text-xs">schedule</span>
                            <span class="text-xs ml-1">Rata-rata 2 jam</span>
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">pending_actions</span>
                    </div>
                </div>
            </div>

            <div class="card p-6 text-white" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Selesai Ditanggapi</p>
                        <p class="text-3xl font-bold mt-2">7</p>
                        <div class="flex items-center mt-3">
                            <span class="material-icons-round text-xs">check_circle</span>
                            <span class="text-xs ml-1">Hari ini</span>
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">task_alt</span>
                    </div>
                </div>
            </div>

            <div class="card p-6 text-white" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm opacity-80">Tingkat Kepuasan</p>
                        <p class="text-3xl font-bold mt-2">92%</p>
                        <div class="flex items-center mt-3">
                            <span class="material-icons-round text-xs">thumb_up</span>
                            <span class="text-xs ml-1">Meningkat</span>
                        </div>
                    </div>
                    <div class="p-3 rounded-full bg-white bg-opacity-20">
                        <span class="material-icons-round">sentiment_satisfied</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feedback Tables -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Feedback untuk Admin -->
            <div class="table-container">
                <div class="table-header flex justify-between items-center">
                    <h3 class="text-xl font-semibold text-gray-800">Umpan Balik untuk Admin</h3>
                    <span class="feedback-badge feedback-admin">Admin</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="p-3 text-left text-gray-600 font-medium">#</th>
                                <th class="p-3 text-left text-gray-600 font-medium">Subjek</th>
                                <th class="p-3 text-left text-gray-600 font-medium">Pengguna</th>
                                <th class="p-3 text-left text-gray-600 font-medium">Dibuat</th>
                                <th class="p-3 text-left text-gray-600 font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-row border-b border-gray-100">
                                <td class="p-3 font-medium text-gray-500">1</td>
                                <td class="p-3">
                                    <p class="font-semibold text-gray-800">Aplikasi crash saat pemesanan</p>
                                    <p class="text-sm text-gray-500">Aplikasi tiba-tiba tertutup saat saya mencoba memesan taksi.</p>
                                </td>
                                <td class="p-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="user-avatar-small avatar-driver">D</div>
                                        <div>
                                            <p class="font-semibold text-gray-800">driver</p>
                                            <p class="text-sm text-gray-500">driver@gmail.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3 text-gray-500">2 Sep 2025</td>
                                <td class="p-3">
                                    <a href="#" class="view-button">
                                        <span class="material-icons-round text-sm mr-1">visibility</span>
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                            <tr class="table-row border-b border-gray-100">
                                <td class="p-3 font-medium text-gray-500">2</td>
                                <td class="p-3">
                                    <p class="font-semibold text-gray-800">Saldo tidak masuk</p>
                                    <p class="text-sm text-gray-500">Saldo yang saya transfer belum masuk ke aplikasi.</p>
                                </td>
                                <td class="p-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="user-avatar-small avatar-user">U</div>
                                        <div>
                                            <p class="font-semibold text-gray-800">user</p>
                                            <p class="text-sm text-gray-500">user@gmail.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3 text-gray-500">3 Sep 2025</td>
                                <td class="p-3">
                                    <a href="#" class="view-button">
                                        <span class="material-icons-round text-sm mr-1">visibility</span>
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="p-3 font-medium text-gray-500">3</td>
                                <td class="p-3">
                                    <p class="font-semibold text-gray-800">Kesalahan pada peta</p>
                                    <p class="text-sm text-gray-500">Lokasi saya tidak akurat di peta aplikasi.</p>
                                </td>
                                <td class="p-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="user-avatar-small avatar-user">U</div>
                                        <div>
                                            <p class="font-semibold text-gray-800">andi</p>
                                            <p class="text-sm text-gray-500">andi@gmail.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3 text-gray-500">1 Sep 2025</td>
                                <td class="p-3">
                                    <a href="#" class="view-button">
                                        <span class="material-icons-round text-sm mr-1">visibility</span>
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Feedback untuk Driver -->
            <div class="table-container">
                <div class="table-header flex justify-between items-center">
                    <h3 class="text-xl font-semibold text-gray-800">Umpan Balik untuk Driver</h3>
                    <span class="feedback-badge feedback-driver">Driver</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="p-3 text-left text-gray-600 font-medium">#</th>
                                <th class="p-3 text-left text-gray-600 font-medium">Subjek</th>
                                <th class="p-3 text-left text-gray-600 font-medium">Pengguna</th>
                                <th class="p-3 text-left text-gray-600 font-medium">Driver</th>
                                <th class="p-3 text-left text-gray-600 font-medium">Dibuat</th>
                                <th class="p-3 text-left text-gray-600 font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-row border-b border-gray-100">
                                <td class="p-3 font-medium text-gray-500">1</td>
                                <td class="p-3">
                                    <p class="font-semibold text-gray-800">Driver terlambat</p>
                                    <p class="text-sm text-gray-500">Driver datang 15 menit terlambat dari jadwal.</p>
                                </td>
                                <td class="p-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="user-avatar-small avatar-user">U</div>
                                        <div>
                                            <p class="font-semibold text-gray-800">user</p>
                                            <p class="text-sm text-gray-500">user@gmail.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="user-avatar-small avatar-driver">D</div>
                                        <div>
                                            <p class="font-semibold text-gray-800">Budi Santoso</p>
                                            <p class="text-sm text-gray-500">driver@gmail.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3 text-gray-500">2 Sep 2025</td>
                                <td class="p-3">
                                    <a href="#" class="view-button">
                                        <span class="material-icons-round text-sm mr-1">visibility</span>
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                            <tr class="table-row border-b border-gray-100">
                                <td class="p-3 font-medium text-gray-500">2</td>
                                <td class="p-3">
                                    <p class="font-semibold text-gray-800">Driver tidak ramah</p>
                                    <p class="text-sm text-gray-500">Driver sangat kasar dan tidak membantu membawa barang.</p>
                                </td>
                                <td class="p-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="user-avatar-small avatar-user">U</div>
                                        <div>
                                            <p class="font-semibold text-gray-800">siti</p>
                                            <p class="text-sm text-gray-500">siti@gmail.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="user-avatar-small avatar-driver">D</div>
                                        <div>
                                            <p class="font-semibold text-gray-800">Ahmad Fauzi</p>
                                            <p class="text-sm text-gray-500">ahmad@gmail.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3 text-gray-500">1 Sep 2025</td>
                                <td class="p-3">
                                    <a href="#" class="view-button">
                                        <span class="material-icons-round text-sm mr-1">visibility</span>
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                            <tr class="table-row">
                                <td class="p-3 font-medium text-gray-500">3</td>
                                <td class="p-3">
                                    <p class="font-semibold text-gray-800">Mobil kotor</p>
                                    <p class="text-sm text-gray-500">Interior mobil sangat kotor dan berantakan.</p>
                                </td>
                                <td class="p-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="user-avatar-small avatar-user">U</div>
                                        <div>
                                            <p class="font-semibold text-gray-800">rudi</p>
                                            <p class="text-sm text-gray-500">rudi@gmail.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="user-avatar-small avatar-driver">D</div>
                                        <div>
                                            <p class="font-semibold text-gray-800">Joko Prasetyo</p>
                                            <p class="text-sm text-gray-500">joko@gmail.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3 text-gray-500">31 Agu 2025</td>
                                <td class="p-3">
                                    <a href="#" class="view-button">
                                        <span class="material-icons-round text-sm mr-1">visibility</span>
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
            <a class="flex items-center p-3 rounded-lg nav-item" href="#">
                <span class="material-icons-round mr-4">receipt_long</span>
                Pesanan
            </a>
            <a class="flex items-center p-3 rounded-lg nav-item" href="#">
                <span class="material-icons-round mr-4">groups</span>
                Pengguna
            </a>
            <a class="flex items-center p-3 rounded-lg nav-item active" href="#">
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
