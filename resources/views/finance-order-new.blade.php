@extends('layouts.app')

@section('title', 'Manajemen Keuangan - TaksiKu')
@section('header', 'Manajemen Keuangan')
@section('subheader', 'Kelola transaksi dan laporan keuangan')
@section('action-button', 'Laporan Baru')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="card p-6 text-white" style="background: linear-gradient(135deg, #10B981 0%, #14B8A6 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Pendapatan Harian</p>
                <p class="text-3xl font-bold mt-2">Rp 8.5M</p>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">trending_up</span>
            </div>
        </div>
    </div>
    <div class="card p-6 text-white" style="background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Komisi Platform</p>
                <p class="text-3xl font-bold mt-2">Rp 1.7M</p>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">account_balance</span>
            </div>
        </div>
    </div>
    <div class="card p-6 text-white" style="background: linear-gradient(135deg, #F59E0B 0%, #F97316 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Pembayaran Driver</p>
                <p class="text-3xl font-bold mt-2">Rp 6.8M</p>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">payments</span>
            </div>
        </div>
    </div>
    <div class="card p-6 text-white" style="background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm opacity-80">Total Transaksi</p>
                <p class="text-3xl font-bold mt-2">1,247</p>
            </div>
            <div class="p-3 rounded-full bg-white bg-opacity-20">
                <span class="material-icons-round">receipt</span>
            </div>
        </div>
    </div>
</div>

<div class="card p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Transaksi Terbaru</h3>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-800">
            <thead class="border-b border-gray-200 text-xs uppercase text-gray-500">
                <tr>
                    <th class="py-3 px-4">ID Transaksi</th>
                    <th class="py-3 px-4">Driver</th>
                    <th class="py-3 px-4">Customer</th>
                    <th class="py-3 px-4">Jumlah</th>
                    <th class="py-3 px-4">Komisi</th>
                    <th class="py-3 px-4">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-200">
                    <td class="py-4 px-4">#TRX001</td>
                    <td class="py-4 px-4">Ahmad Rifai</td>
                    <td class="py-4 px-4">Sarah Johnson</td>
                    <td class="py-4 px-4">Rp 125,000</td>
                    <td class="py-4 px-4">Rp 25,000</td>
                    <td class="py-4 px-4">15 Mar 2024</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
