@extends('layouts.app')

@section('title', 'Detail Saldo - TaksiKu')
@section('header', 'Detail Saldo')
@section('subheader', 'Informasi lengkap transaksi saldo')
@section('action-button', 'Proses Transaksi')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
        <div class="card p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Transaksi</h3>
            <div class="space-y-3">
                <div>
                    <label class="text-sm font-medium text-gray-500">ID Transaksi</label>
                    <p class="text-gray-900">#BAL001</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Driver</label>
                    <p class="text-gray-900">Ahmad Rifai</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Jumlah</label>
                    <p class="text-gray-900">Rp 500,000</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Status</label>
                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-sm">Menunggu</span>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:col-span-2">
        <div class="card p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Pembayaran</h3>
            <div class="space-y-4">
                <div class="p-4 bg-gray-50 rounded-lg">
                    <div class="font-medium">Metode Pembayaran</div>
                    <div class="text-gray-600">Transfer Bank - BCA</div>
                </div>
                <div class="p-4 bg-gray-50 rounded-lg">
                    <div class="font-medium">Nomor Rekening</div>
                    <div class="text-gray-600">1234567890</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
