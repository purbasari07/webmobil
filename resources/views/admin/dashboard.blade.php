@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Header Page -->
    <div>
        <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Dashboard Admin</h2>
        <p class="text-slate-500 text-xs mt-1">Kelola data master layanan servis dan stok sparepart bengkel.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Card Services -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Layanan Servis</span>
                <span class="p-2 bg-indigo-50 text-indigo-600 rounded-lg">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </span>
            </div>
            <div class="mt-3 flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ $servicesCount }}</span>
                <span class="text-xs text-slate-500">layanan</span>
            </div>
        </div>

        <!-- Card Spareparts -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Stok Sparepart</span>
                <span class="p-2 bg-sky-50 text-sky-600 rounded-lg">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </span>
            </div>
            <div class="mt-3 flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ $sparepartsCount }}</span>
                <span class="text-xs text-slate-500">item</span>
            </div>
        </div>

        <!-- Card Total Bookings -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Booking</span>
                <span class="p-2 bg-emerald-50 text-emerald-600 rounded-lg">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </span>
            </div>
            <div class="mt-3 flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ $totalBookings }}</span>
                <span class="text-xs text-slate-500">transaksi</span>
            </div>
        </div>

        <!-- Card Pending Queue -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Antrean Pending</span>
                <span class="p-2 bg-amber-50 text-amber-600 rounded-lg">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
            </div>
            <div class="mt-3 flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ $pendingBookings }}</span>
                <span class="text-xs text-slate-500">antrean</span>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-slate-900 p-6 rounded-xl text-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-5 shadow-lg shadow-slate-900/10">
        <div class="space-y-1.5">
            <h3 class="text-lg font-bold tracking-tight">Kelola Data Bengkel</h3>
            <p class="text-slate-400 text-xs">Mulai konfigurasi master layanan servis atau perbarui jumlah ketersediaan suku cadang.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.services.index') }}" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-semibold rounded-lg transition shadow-md shadow-indigo-600/20">
                Kelola Servis
            </a>
            <a href="{{ route('admin.spareparts.index') }}" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold rounded-lg border border-slate-700 transition">
                Kelola Sparepart
            </a>
        </div>
    </div>
</div>
@endsection
