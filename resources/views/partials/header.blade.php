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
            @yield('action-button', 'Pesanan Baru')
        </button>
    </div>
</header>
