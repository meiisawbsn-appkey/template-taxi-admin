@extends('layouts.app')

@section('title', 'Detail Umpan Balik - TaksiKu')
@section('header', 'Detail Umpan Balik')
@section('subheader', 'Informasi lengkap feedback pengguna')
@section('action-button', 'Balas Feedback')

@section('content')
<div class="card p-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pengguna</h3>
            <div class="flex items-center mb-4">
                <img alt="Sarah Johnson" class="w-12 h-12 rounded-full mr-4" src="https://picsum.photos/seed/sarah3/48/48.jpg">
                <div>
                    <div class="font-medium text-gray-900">Sarah Johnson</div>
                    <div class="text-gray-500">Customer</div>
                </div>
            </div>
            <div class="space-y-2">
                <div><span class="font-medium">Trip ID:</span> #TK2024001</div>
                <div><span class="font-medium">Rating:</span> ⭐⭐⭐⭐⭐ (5.0)</div>
                <div><span class="font-medium">Tanggal:</span> 15 Mar 2024</div>
            </div>
        </div>

        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Umpan Balik</h3>
            <div class="p-4 bg-gray-50 rounded-lg">
                <p class="text-gray-900">Driver sangat ramah dan profesional. Perjalanan sangat nyaman dan aman. Kendaraan dalam kondisi bersih dan terawat. Sangat merekomendasikan!</p>
            </div>
            <div class="mt-4">
                <h4 class="font-medium text-gray-800 mb-2">Respon Admin</h4>
                <textarea class="w-full p-3 border border-gray-300 rounded-lg" rows="4" placeholder="Tulis respon..."></textarea>
                <button class="btn-primary mt-2 px-4 py-2">Kirim Respon</button>
            </div>
        </div>
    </div>
</div>
@endsection
