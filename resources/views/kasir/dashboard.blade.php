@extends('layouts.app')

@section('title', 'Kasir Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Portal Kasir</h2>
            <p class="text-slate-500 text-sm mt-1 font-medium">Registrasi antrean offline, proses checkout suku cadang, dan kelola pembayaran servis.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('kasir.booking.offline') }}" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-bold rounded-lg transition shadow-md shadow-indigo-600/20 flex items-center gap-2">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Booking Offline</span>
            </a>
            <a href="{{ route('kasir.direct-sale') }}" class="px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-bold rounded-lg transition shadow-md flex items-center gap-2">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                <span>Penjualan Langsung</span>
            </a>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Active Queue (Left side - Col span 2) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Completed & Unpaid Queue (High Priority) -->
            <div class="space-y-4">
                <h3 class="text-xl font-extrabold text-slate-800 tracking-tight flex items-center gap-2">
                    <span>Menunggu Pembayaran (Servis Selesai)</span>
                </h3>
                
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 text-slate-500 text-xs font-bold uppercase tracking-widest border-b border-slate-200">
                                    <th class="px-5 py-4">Customer & Mobil</th>
                                    <th class="px-5 py-4">Layanan</th>
                                    <th class="px-5 py-4">Estimasi Harga</th>
                                    <th class="px-5 py-4 text-center">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                                @forelse($completedBookings as $booking)
                                    <tr class="hover:bg-slate-50/80 transition">
                                        <td class="px-5 py-4">
                                            <div class="text-lg font-extrabold text-slate-900 mb-0.5">{{ $booking->user ? $booking->user->name : 'Walk-In Customer' }}</div>
                                            <div class="text-xs text-slate-500 font-bold">{{ $booking->vehicle->brand }} {{ $booking->vehicle->model }} ({{ $booking->vehicle->license_plate }})</div>
                                        </td>
                                        <td class="px-5 py-4">
                                            <div class="text-base font-bold text-slate-800 mb-0.5">{{ $booking->service->service_name }}</div>
                                            <span class="text-xs text-indigo-600 font-bold capitalize">Mekanik: {{ $booking->transaction->mekanik ? $booking->transaction->mekanik->name : 'Mekanik' }}</span>
                                        </td>
                                        <td class="px-5 py-4 text-lg font-extrabold text-slate-900">
                                            Rp {{ number_format($booking->transaction->grand_total, 0, ',', '.') }}
                                        </td>
                                        <td class="px-5 py-4 text-center whitespace-nowrap">
                                            <a href="{{ route('kasir.checkout', $booking) }}" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-extrabold rounded-lg transition shadow-md shadow-emerald-600/20 inline-block">
                                                Checkout & Bayar
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-5 py-8 text-center text-slate-500 italic text-base font-medium">
                                            Tidak ada mobil servis selesai yang menunggu pembayaran.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Active Queue (Pending, Confirmed, In Progress) -->
            <div class="space-y-4">
                <h3 class="text-xl font-extrabold text-slate-800 tracking-tight">Antrean Servis Aktif</h3>
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 text-slate-500 text-xs font-bold uppercase tracking-widest border-b border-slate-200">
                                    <th class="px-5 py-4">Customer & Mobil</th>
                                    <th class="px-5 py-4">Layanan</th>
                                    <th class="px-5 py-4">Jadwal</th>
                                    <th class="px-5 py-4">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                                @forelse($activeBookings as $booking)
                                    <tr class="hover:bg-slate-50/80 transition">
                                        <td class="px-5 py-4">
                                            <div class="text-lg font-extrabold text-slate-900 mb-0.5">{{ $booking->user ? $booking->user->name : 'Walk-In Customer' }}</div>
                                            <div class="text-xs text-slate-500 font-bold">{{ $booking->vehicle->brand }} {{ $booking->vehicle->model }} &bull; {{ $booking->vehicle->license_plate }}</div>
                                        </td>
                                        <td class="px-5 py-4 text-base font-bold text-slate-800">
                                            {{ $booking->service->service_name }}
                                        </td>
                                        <td class="px-5 py-4 whitespace-nowrap">
                                            <div class="text-base font-bold text-slate-800 mb-0.5">{{ Carbon\Carbon::parse($booking->booking_date)->isoFormat('D MMM YYYY') }}</div>
                                            <div class="text-xs text-slate-500 font-bold">{{ substr($booking->booking_time, 0, 5) }} WIB</div>
                                        </td>
                                        <td class="px-5 py-4 whitespace-nowrap">
                                            @if($booking->status === 'Pending')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-amber-50 text-amber-700 border border-amber-200">
                                                    Pending
                                                </span>
                                            @elseif($booking->status === 'Confirmed')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-blue-50 text-blue-700 border border-blue-200">
                                                    Confirmed
                                                </span>
                                            @elseif($booking->status === 'In Progress')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-purple-50 text-purple-700 border border-purple-200">
                                                    In Progress
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-5 py-8 text-center text-slate-500 italic text-base font-medium">
                                            Tidak ada antrean servis aktif saat ini.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions Sidebar (Right side - Col span 1) -->
        <div class="lg:col-span-1 space-y-4">
            <h3 class="text-xl font-extrabold text-slate-800 tracking-tight">Transaksi Terakhir (Lunas)</h3>
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 space-y-3">
                @forelse($transactions as $tx)
                    <div class="p-4 border border-slate-100 rounded-xl hover:border-indigo-300 transition flex items-center justify-between">
                        <div>
                            @if($tx->booking)
                                <h4 class="text-base font-extrabold text-slate-900 mb-0.5">{{ $tx->booking->user ? $tx->booking->user->name : 'Walk-In Customer' }}</h4>
                                <p class="text-xs text-slate-500 font-bold">Servis: {{ $tx->booking->service->service_name }}</p>
                            @else
                                <h4 class="text-base font-extrabold text-slate-900 mb-0.5">Penjualan Langsung</h4>
                                <p class="text-xs text-slate-500 font-bold">Sparepart langsung</p>
                            @endif
                            <span class="text-[10px] text-slate-400 mt-1.5 font-semibold inline-block">{{ $tx->payment ? Carbon\Carbon::parse($tx->payment->payment_date)->diffForHumans() : $tx->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-lg font-extrabold text-slate-900 block mb-1">Rp {{ number_format($tx->grand_total, 0, ',', '.') }}</span>
                            <a href="{{ route('invoice.print', $tx) }}" target="_blank" class="text-indigo-600 hover:text-indigo-700 text-xs font-extrabold inline-block">Nota &rarr;</a>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-400 text-base font-medium italic text-center py-6">Belum ada transaksi lunas hari ini.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
