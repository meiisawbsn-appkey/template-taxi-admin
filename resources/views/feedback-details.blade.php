<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Detail Umpan Balik - TaksiKu</title>
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

        .feedback-card {
            position: relative;
            overflow: hidden;
        }

        .feedback-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        }

        .feedback-message {
            line-height: 1.6;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .status-pending {
            background: linear-gradient(135deg, #F59E0B, #D97706);
            color: white;
            box-shadow: 0 2px 10px rgba(245, 158, 11, 0.3);
        }

        .status-resolved {
            background: linear-gradient(135deg, #10B981, #059669);
            color: white;
            box-shadow: 0 2px 10px rgba(16, 185, 129, 0.3);
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
                <h2 class="text-2xl font-bold text-white">Detail Umpan Balik</h2>
                <p class="text-white/80 text-sm">Lihat dan kelola umpan balik dari pengguna</p>
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
                </button>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <div class="flex-1 overflow-y-auto p-4 md:p-6">
        <!-- Back Button -->
        <div class="mb-6">
            <button class="flex items-center text-white/80 hover:text-white transition-colors">
                <span class="material-icons-round text-2xl">arrow_back</span>
                <span class="ml-2">Kembali</span>
            </button>
        </div>

        <!-- Feedback Details -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Feedback Message -->
            <div class="lg:col-span-2 card p-6 feedback-card">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Pesan Umpan Balik</h3>
                    <span class="status-badge status-pending">Menunggu</span>
                </div>
                <p class="feedback-message text-gray-700 mb-6">
                    Aplikasi crash saat saya mencoba memesan taksi dari pusat kota ke bandara. Error terjadi setelah memilih metode pembayaran. Saya sudah mencoba beberapa kali tetapi hasilnya sama. Mohon perbaiki segera karena saya sangat membutuhkan layanan ini untuk perjalanan besok pagi.
                </p>
                <div class="flex items-center text-gray-500 text-sm">
                    <span class="material-icons-round text-sm mr-1">schedule</span>
                    <span>2 Sep 2025, 14:43</span>
                </div>

                <!-- Response Section -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h4 class="text-lg font-semibold mb-4 text-gray-800">Tanggapan Admin</h4>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <textarea class="w-full p-3 border border-gray-300 rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4" placeholder="Ketik tanggapan Anda di sini..."></textarea>
                        <div class="flex justify-end mt-3">
                            <button class="btn-primary px-6 py-2 font-medium">
                                Kirim Tanggapan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Information -->
            <div class="card p-6">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Informasi Pengguna</h3>
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center font-bold text-white text-xl">
                        U
                    </div>
                    <div class="ml-4">
                        <p class="font-semibold text-gray-800 text-lg">user</p>
                        <p class="text-sm text-gray-500">user@gmail.com</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider">ID Pengguna</p>
                        <p class="font-medium text-gray-800">#USR-2025-0942</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider">Telepon</p>
                        <p class="font-medium text-gray-800">+628123456789</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider">Tanggal Bergabung</p>
                        <p class="font-medium text-gray-800">15 Jan 2024</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider">Total Perjalanan</p>
                        <p class="font-medium text-gray-800">47</p>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <button class="w-full btn-primary py-2 font-medium">
                        Lihat Profil Pengguna
                    </button>
                </div>
            </div>
        </div>

        <!-- Related Feedbacks -->
        <div class="card p-6">
            <h3 class="text-xl font-semibold mb-4 text-gray-800">Umpan Balik Terkait</h3>
            <div class="space-y-4">
                <div class="border-l-4 border-blue-500 pl-4 py-2">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-medium text-gray-800">Aplikasi tidak bisa menampilkan peta</p>
                            <p class="text-sm text-gray-500 mt-1">Peta tidak muncul saat saya membuka aplikasi. Padahal GPS sudah aktif.</p>
                        </div>
                        <span class="status-badge status-resolved">Selesai</span>
                    </div>
                    <div class="flex items-center text-gray-500 text-xs mt-2">
                        <span class="material-icons-round text-xs mr-1">schedule</span>
                        <span>25 Agu 2025, 09:15</span>
                    </div>
                </div>

                <div class="border-l-4 border-yellow-500 pl-4 py-2">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-medium text-gray-800">Driver tidak datang</p>
                            <p class="text-sm text-gray-500 mt-1">Saya sudah menunggu 30 menit tapi driver tidak datang dan tidak ada kabar.</p>
                        </div>
                        <span class="status-badge status-pending">Menunggu</span>
                    </div>
                    <div class="flex items-center text-gray-500 text-xs mt-2">
                        <span class="material-icons-round text-xs mr-1">schedule</span>
                        <span>20 Agu 2025, 16:30</span>
                    </div>
                </div>

                <div class="border-l-4 border-green-500 pl-4 py-2">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-medium text-gray-800">Kesalahan pada pembayaran</p>
                            <p class="text-sm text-gray-500 mt-1">Saya sudah membayar tapi status pembayaran masih pending.</p>
                        </div>
                        <span class="status-badge status-resolved">Selesai</span>
                    </div>
                    <div class="flex items-center text-gray-500 text-xs mt-2">
                        <span class="material-icons-round text-xs mr-1">schedule</span>
                        <span>15 Agu 2025, 11:45</span>
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
                <span>123 ms</span>
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
