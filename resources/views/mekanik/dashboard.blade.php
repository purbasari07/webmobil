@extends('layouts.app')

@section('title', 'Mekanik Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Header Page -->
    <div>
        <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Tabel Antrean Mekanik</h2>
        <p class="text-slate-500 text-sm mt-1 font-medium">Pantau antrean masuk, lakukan ACC, dan perbarui status pekerjaan servis mobil secara berurutan.</p>
    </div>

    <!-- Queue Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-xs font-bold uppercase tracking-widest border-b border-slate-200">
                        <th class="px-5 py-4">Pelanggan & Mobil</th>
                        <th class="px-5 py-4">Layanan / Keluhan</th>
                        <th class="px-5 py-4">Waktu Booking</th>
                        <th class="px-5 py-4">Tipe Booking</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4 text-center">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-slate-50/80 transition">
                            <!-- User & Vehicle -->
                            <td class="px-5 py-4">
                                <div class="text-lg font-extrabold text-slate-900 mb-0.5">{{ $booking->user ? $booking->user->name : 'Walk-In Customer' }}</div>
                                <div class="text-xs text-slate-500 font-bold">
                                    {{ $booking->vehicle->brand }} {{ $booking->vehicle->model }} &bull; <span class="text-indigo-600 font-extrabold">{{ $booking->vehicle->license_plate }}</span>
                                </div>
                            </td>

                            <!-- Service / Complaint -->
                            <td class="px-5 py-4">
                                <div class="text-base font-bold text-slate-800 mb-0.5">{{ $booking->service->service_name }}</div>
                                <p class="text-xs text-slate-500 max-w-sm mt-0.5 italic">"{{ $booking->complaint ?? 'Tidak ada keluhan tertulis' }}"</p>
                            </td>

                            <!-- Schedule -->
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="text-base font-bold text-slate-800 mb-0.5">{{ Carbon\Carbon::parse($booking->booking_date)->isoFormat('D MMM YYYY') }}</div>
                                <div class="text-xs text-slate-500 font-bold">{{ substr($booking->booking_time, 0, 5) }} WIB</div>
                            </td>

                            <!-- Booking Type (Online/Offline) -->
                            <td class="px-5 py-4 whitespace-nowrap">
                                @if($booking->is_offline)
                                    <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                        Offline (Walk-In)
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-bold bg-indigo-50 text-indigo-600 border border-indigo-200">
                                        Online (Web)
                                    </span>
                                @endif
                            </td>

                            <!-- Status Badge -->
                            <td class="px-5 py-4 whitespace-nowrap">
                                @if($booking->status === 'Pending')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-amber-50 text-amber-700 border border-amber-200">
                                        Pending
                                    </span>
                                @elseif($booking->status === 'Confirmed')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-blue-50 text-blue-700 border border-blue-200">
                                        Confirmed (ACC)
                                    </span>
                                @elseif($booking->status === 'In Progress')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-purple-50 text-purple-700 border border-purple-200">
                                        In Progress
                                    </span>
                                @elseif($booking->status === 'Completed')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Completed
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="px-5 py-4 text-center whitespace-nowrap">
                                @if($booking->status === 'Pending')
                                    <form action="{{ route('mekanik.booking.acc', $booking) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white text-xs font-extrabold rounded-lg transition shadow-md shadow-blue-600/20">
                                            ACC Antrean
                                        </button>
                                    </form>
                                @elseif($booking->status === 'Confirmed')
                                    <form action="{{ route('mekanik.booking.start', $booking) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-500 text-white text-xs font-extrabold rounded-lg transition shadow-md shadow-purple-600/20">
                                            Mulai Pengerjaan
                                        </button>
                                    </form>
                                @elseif($booking->status === 'In Progress')
                                    <form action="{{ route('mekanik.booking.complete', $booking) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-extrabold rounded-lg transition shadow-md shadow-emerald-600/20">
                                            Selesaikan Servis
                                        </button>
                                    </form>
                                @elseif($booking->status === 'Completed')
                                    <span class="inline-flex items-center gap-1.5 text-emerald-600 text-xs font-extrabold">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                        <span>Selesai &bull; Menunggu Kasir</span>
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center text-slate-500">
                                <svg class="mx-auto h-10 w-10 text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2"/></svg>
                                <span class="font-bold text-base text-slate-600">Tidak ada antrean servis saat ini</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
