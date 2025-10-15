@extends('layouts.app')

@section('title', 'Detail Pengguna - TaksiKu')
@section('header', 'Detail Pengguna')
@section('subheader', 'Informasi lengkap profil pengguna')
@section('action-button', 'Edit Pengguna')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- User Profile -->
    <div class="lg:col-span-1">
        <div class="card p-6">
            <div class="text-center">
                <img alt="John Doe" class="w-24 h-24 rounded-full mx-auto mb-4" src="https://picsum.photos/seed/john2/96/96.jpg">
                <h3 class="text-lg font-semibold text-gray-900">John Doe</h3>
                <p class="text-gray-500">Customer</p>
                <div class="mt-4 flex justify-center">
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Aktif</span>
                </div>
            </div>

            <div class="mt-6 space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-500">Email</label>
                    <p class="text-gray-900">john.doe@example.com</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Telepon</label>
                    <p class="text-gray-900">+62 812-3456-7890</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Bergabung</label>
                    <p class="text-gray-900">15 Jan 2024</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Terakhir Login</label>
                    <p class="text-gray-900">2 jam yang lalu</p>
                </div>
            </div>
        </div>
    </div>

    <!-- User Activity -->
    <div class="lg:col-span-2">
        <div class="card p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Pengguna</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="text-center p-4 bg-blue-50 rounded-lg">
                    <div class="text-2xl font-bold text-blue-600">47</div>
                    <div class="text-sm text-gray-600">Total Perjalanan</div>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <div class="text-2xl font-bold text-green-600">Rp 2.8M</div>
                    <div class="text-sm text-gray-600">Total Pengeluaran</div>
                </div>
                <div class="text-center p-4 bg-yellow-50 rounded-lg">
                    <div class="text-2xl font-bold text-yellow-600">4.8</div>
                    <div class="text-sm text-gray-600">Rating Rata-rata</div>
                </div>
            </div>

            <h4 class="font-medium text-gray-800 mb-3">Riwayat Perjalanan Terbaru</h4>
            <div class="space-y-3">
                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                    <div>
                        <div class="font-medium text-gray-900">#TK2024001</div>
                        <div class="text-sm text-gray-500">Mall Taman Anggrek → Bandara</div>
                    </div>
                    <div class="text-right">
                        <div class="font-medium text-gray-900">Rp 125,000</div>
                        <div class="text-sm text-gray-500">15 Mar 2024</div>
                    </div>
                </div>
                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                    <div>
                        <div class="font-medium text-gray-900">#TK2024002</div>
                        <div class="text-sm text-gray-500">Stasiun Gambir → Hotel Indonesia</div>
                    </div>
                    <div class="text-right">
                        <div class="font-medium text-gray-900">Rp 45,000</div>
                        <div class="text-sm text-gray-500">14 Mar 2024</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
