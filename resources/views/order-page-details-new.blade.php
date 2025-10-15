@extends('layouts.app')

@section('title', 'Detail Pesanan - TaksiKu')
@section('header', 'Detail Pesanan')
@section('subheader', 'Informasi lengkap pesanan taksi')
@section('action-button', 'Track Perjalanan')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="card p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pesanan</h3>
        <div class="space-y-4">
            <div>
                <label class="text-sm font-medium text-gray-500">ID Pesanan</label>
                <p class="text-gray-900 font-medium">#TK2024001</p>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-500">Status</label>
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Sedang Berlangsung</span>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-500">Waktu Pesanan</label>
                <p class="text-gray-900">15 Mar 2024, 14:25</p>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-500">Rute</label>
                <div class="bg-gray-50 p-3 rounded-lg">
                    <div class="flex items-center mb-2">
                        <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                        <span>Mall Taman Anggrek</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                        <span>Bandara Soekarno-Hatta</span>
                    </div>
                </div>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-500">Jarak & Tarif</label>
                <div class="bg-gray-50 p-3 rounded-lg">
                    <div class="flex justify-between">
                        <span>Jarak:</span>
                        <span>35.2 km</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Tarif:</span>
                        <span class="font-medium">Rp 125,000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Customer & Driver</h3>
        <div class="space-y-6">
            <div>
                <h4 class="font-medium text-gray-800 mb-2">Customer</h4>
                <div class="flex items-center">
                    <img alt="Sarah Johnson" class="w-10 h-10 rounded-full mr-3" src="https://picsum.photos/seed/sarah4/40/40.jpg">
                    <div>
                        <div class="font-medium text-gray-900">Sarah Johnson</div>
                        <div class="text-gray-500 text-sm">+62 812-3456-7890</div>
                    </div>
                </div>
            </div>

            <div>
                <h4 class="font-medium text-gray-800 mb-2">Driver</h4>
                <div class="flex items-center">
                    <img alt="Ahmad Rifai" class="w-10 h-10 rounded-full mr-3" src="https://picsum.photos/seed/ahmad6/40/40.jpg">
                    <div>
                        <div class="font-medium text-gray-900">Ahmad Rifai</div>
                        <div class="text-gray-500 text-sm">B 1234 XYZ - Toyota Vios</div>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t">
                <h4 class="font-medium text-gray-800 mb-2">Progress Perjalanan</h4>
                <div class="space-y-2">
                    <div class="flex items-center">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>
                        <span class="text-sm">Driver menuju lokasi pickup</span>
                        <span class="text-xs text-gray-500 ml-auto">14:25</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-3"></span>
                        <span class="text-sm">Driver tiba di lokasi pickup</span>
                        <span class="text-xs text-gray-500 ml-auto">14:32</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                        <span class="text-sm">Perjalanan dimulai</span>
                        <span class="text-xs text-gray-500 ml-auto">14:35</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
