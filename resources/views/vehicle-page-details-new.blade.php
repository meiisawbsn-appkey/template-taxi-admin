@extends('layouts.app')

@section('title', 'Detail Kendaraan - TaksiKu')
@section('header', 'Detail Kendaraan')
@section('subheader', 'Informasi lengkap kendaraan dan driver')
@section('action-button', 'Edit Kendaraan')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="card p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Kendaraan</h3>
        <div class="space-y-4">
            <div>
                <label class="text-sm font-medium text-gray-500">Plat Nomor</label>
                <p class="text-gray-900 font-medium">B 1234 XYZ</p>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-500">Merk & Model</label>
                <p class="text-gray-900">Toyota Vios</p>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-500">Tahun</label>
                <p class="text-gray-900">2019</p>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-500">Tipe Mesin</label>
                <p class="text-gray-900">1.5L Manual</p>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-500">Status</label>
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Aktif</span>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-500">Terakhir Online</label>
                <p class="text-gray-900">2 jam yang lalu</p>
            </div>
        </div>
    </div>

    <div class="card p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Driver</h3>
        <div class="flex items-center mb-4">
            <img alt="Ahmad Rifai" class="w-16 h-16 rounded-full mr-4" src="https://picsum.photos/seed/ahmad7/64/64.jpg">
            <div>
                <div class="font-medium text-gray-900">Ahmad Rifai</div>
                <div class="text-gray-500">Driver ID: DRV001</div>
                <div class="text-gray-500">+62 812-3456-7890</div>
            </div>
        </div>

        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-gray-600">Rating:</span>
                <span>⭐⭐⭐⭐⭐ (4.8)</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Total Trip:</span>
                <span>247</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Bergabung:</span>
                <span>15 Jan 2024</span>
            </div>
        </div>
    </div>
</div>

<div class="card p-6 mt-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Riwayat Perjalanan Terbaru</h3>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-800">
            <thead class="border-b border-gray-200 text-xs uppercase text-gray-500">
                <tr>
                    <th class="py-3 px-4">ID Trip</th>
                    <th class="py-3 px-4">Customer</th>
                    <th class="py-3 px-4">Rute</th>
                    <th class="py-3 px-4">Tarif</th>
                    <th class="py-3 px-4">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-200">
                    <td class="py-4 px-4">#TK2024001</td>
                    <td class="py-4 px-4">Sarah Johnson</td>
                    <td class="py-4 px-4">Mall Taman Anggrek → Bandara</td>
                    <td class="py-4 px-4">Rp 125,000</td>
                    <td class="py-4 px-4">15 Mar 2024</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
