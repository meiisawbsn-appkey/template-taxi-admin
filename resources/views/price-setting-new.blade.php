@extends('layouts.app')

@section('title', 'Pengaturan Tarif - TaksiKu')
@section('header', 'Pengaturan Tarif')
@section('subheader', 'Kelola tarif perjalanan dan biaya layanan')
@section('action-button', 'Tambah Tarif')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="card p-6 text-white" style="background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Tarif Dasar</p>
                <p class="text-3xl font-bold mt-2">Rp 7,000</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">payments</span>
                    <span class="text-xs ml-1">Per kilometer</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">local_taxi</span>
            </div>
        </div>
    </div>

    <div class="card p-6 text-white" style="background: linear-gradient(135deg, #10B981 0%, #14B8A6 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Tarif Peak Hour</p>
                <p class="text-3xl font-bold mt-2">Rp 10,500</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">trending_up</span>
                    <span class="text-xs ml-1">+50% dari tarif dasar</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">schedule</span>
            </div>
        </div>
    </div>

    <div class="card p-6 text-white" style="background: linear-gradient(135deg, #F59E0B 0%, #F97316 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Biaya Minimal</p>
                <p class="text-3xl font-bold mt-2">Rp 15,000</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">low_priority</span>
                    <span class="text-xs ml-1">Jarak pendek</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">money</span>
            </div>
        </div>
    </div>

    <div class="card p-6 text-white" style="background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Komisi Platform</p>
                <p class="text-3xl font-bold mt-2">20%</p>
                <div class="flex items-center mt-3">
                    <span class="material-icons-round text-xs">percent</span>
                    <span class="text-xs ml-1">Dari total tarif</span>
                </div>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">account_balance</span>
            </div>
        </div>
    </div>
</div>

<!-- Pricing Settings -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="card p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Tarif Per Jenis Layanan</h3>
        <div class="space-y-4">
            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                <div>
                    <div class="font-medium text-gray-900">TaksiKu Regular</div>
                    <div class="text-sm text-gray-500">Layanan standar</div>
                </div>
                <div class="text-right">
                    <div class="font-medium text-gray-900">Rp 7,000/km</div>
                    <button class="text-blue-600 text-sm hover:text-blue-800">Edit</button>
                </div>
            </div>
            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                <div>
                    <div class="font-medium text-gray-900">TaksiKu Express</div>
                    <div class="text-sm text-gray-500">Layanan cepat</div>
                </div>
                <div class="text-right">
                    <div class="font-medium text-gray-900">Rp 9,000/km</div>
                    <button class="text-blue-600 text-sm hover:text-blue-800">Edit</button>
                </div>
            </div>
            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                <div>
                    <div class="font-medium text-gray-900">TaksiKu Premium</div>
                    <div class="text-sm text-gray-500">Kendaraan mewah</div>
                </div>
                <div class="text-right">
                    <div class="font-medium text-gray-900">Rp 12,000/km</div>
                    <button class="text-blue-600 text-sm hover:text-blue-800">Edit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Pengaturan Waktu</h3>
        <div class="space-y-4">
            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                <div>
                    <div class="font-medium text-gray-900">Peak Hour</div>
                    <div class="text-sm text-gray-500">07:00 - 09:00, 17:00 - 19:00</div>
                </div>
                <div class="text-right">
                    <div class="font-medium text-gray-900">+50%</div>
                    <button class="text-blue-600 text-sm hover:text-blue-800">Edit</button>
                </div>
            </div>
            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                <div>
                    <div class="font-medium text-gray-900">Malam Hari</div>
                    <div class="text-sm text-gray-500">22:00 - 05:00</div>
                </div>
                <div class="text-right">
                    <div class="font-medium text-gray-900">+25%</div>
                    <button class="text-blue-600 text-sm hover:text-blue-800">Edit</button>
                </div>
            </div>
            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                <div>
                    <div class="font-medium text-gray-900">Hari Libur</div>
                    <div class="text-sm text-gray-500">Sabtu, Minggu, hari raya</div>
                </div>
                <div class="text-right">
                    <div class="font-medium text-gray-900">+30%</div>
                    <button class="text-blue-600 text-sm hover:text-blue-800">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
