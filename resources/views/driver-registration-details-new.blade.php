@extends('layouts.app')

@section('title', 'Detail Registrasi Driver - TaksiKu')
@section('header', 'Detail Registrasi Driver')
@section('subheader', 'Informasi lengkap aplikasi driver')
@section('action-button', 'Proses Aplikasi')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
        <div class="card p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pelamar</h3>
            <div class="text-center mb-4">
                <img alt="Budi Hartono" class="w-20 h-20 rounded-full mx-auto mb-3" src="https://picsum.photos/seed/budi5/80/80.jpg">
                <h4 class="font-medium text-gray-900">Budi Hartono</h4>
                <p class="text-gray-500">Calon Driver</p>
            </div>

            <div class="space-y-3">
                <div>
                    <label class="text-sm font-medium text-gray-500">Telepon</label>
                    <p class="text-gray-900">+62 812-9876-5432</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Email</label>
                    <p class="text-gray-900">budi.hartono@email.com</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Tanggal Daftar</label>
                    <p class="text-gray-900">15 Mar 2024</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Status</label>
                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-sm">Menunggu Verifikasi</span>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:col-span-2">
        <div class="card p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Kendaraan & Dokumen</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h4 class="font-medium text-gray-800 mb-3">Kendaraan</h4>
                    <div class="space-y-2">
                        <div><span class="font-medium">Merk:</span> Toyota Avanza</div>
                        <div><span class="font-medium">Plat:</span> B 9876 DEF</div>
                        <div><span class="font-medium">Tahun:</span> 2018</div>
                        <div><span class="font-medium">Warna:</span> Silver</div>
                    </div>
                </div>

                <div>
                    <h4 class="font-medium text-gray-800 mb-3">Status Dokumen</h4>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span>KTP</span>
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">✓ Verified</span>
                        </div>
                        <div class="flex justify-between">
                            <span>SIM A</span>
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">✓ Verified</span>
                        </div>
                        <div class="flex justify-between">
                            <span>STNK</span>
                            <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">⏳ Pending</span>
                        </div>
                        <div class="flex justify-between">
                            <span>SKCK</span>
                            <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded">✗ Missing</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t pt-4">
                <h4 class="font-medium text-gray-800 mb-3">Aksi Verifikasi</h4>
                <div class="flex space-x-3">
                    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Setujui Aplikasi
                    </button>
                    <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Tolak Aplikasi
                    </button>
                    <button class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                        Minta Dokumen Tambahan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
