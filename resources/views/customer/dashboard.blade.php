@extends('layouts.app')

@section('title', 'Customer Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Dashboard Mobilku</h2>
            <p class="text-slate-500 text-sm mt-1 font-medium">Daftarkan mobil Anda dan jadwalkan booking servis dengan mudah.</p>
        </div>
        <a href="{{ route('customer.booking.create') }}" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-bold rounded-xl transition shadow-md shadow-indigo-600/20 flex items-center justify-center gap-2 self-start sm:self-auto">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <span>Booking Servis</span>
        </a>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Side: Vehicles Info -->
        <div class="space-y-6 lg:col-span-1">
            <!-- Add Vehicle Card -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
                <h3 class="text-xl font-extrabold text-slate-800 tracking-tight">Daftarkan Mobil Baru</h3>
                <form action="{{ route('customer.vehicles.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="brand" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Merek</label>
                        <input type="text" name="brand" id="brand" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm font-medium" placeholder="Contoh: Toyota">
                    </div>
                    <div>
                        <label for="model" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Model / Seri</label>
                        <input type="text" name="model" id="model" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm font-medium" placeholder="Contoh: Avanza">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="year" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Tahun</label>
                            <input type="number" name="year" id="year" required min="1900" max="{{ date('Y')+1 }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm font-medium" placeholder="2021">
                        </div>
                        <div>
                            <label for="color" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Warna</label>
                            <input type="text" name="color" id="color" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm font-medium" placeholder="Contoh: Hitam">
                        </div>
                    </div>
                    <div>
                        <label for="license_plate" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Nomor Polisi (Plat)</label>
                        <input type="text" name="license_plate" id="license_plate" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm font-medium" placeholder="Contoh: B 1234 ABC">
                    </div>
                    <button type="submit" class="w-full py-3 bg-slate-900 hover:bg-slate-800 text-white text-sm font-extrabold rounded-xl transition shadow-md">
                        Simpan Mobil
                    </button>
                </form>
            </div>

            <!-- List Vehicles -->
            <div class="space-y-4">
                <h3 class="text-xl font-extrabold text-slate-800 tracking-tight">Mobil Saya</h3>
                @forelse($vehicles as $veh)
                    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between hover:border-indigo-300 transition">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 font-extrabold text-xs">
                                CAR
                            </div>
                            <div>
                                <h4 class="text-base font-extrabold text-slate-800 leading-none mb-1">{{ $veh->brand }} {{ $veh->model }}</h4>
                                <span class="text-xs text-slate-400 font-medium">{{ $veh->license_plate }} &bull; {{ $veh->color }} ({{ $veh->year }})</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-400 text-sm italic font-medium">Belum ada mobil terdaftar. Silakan daftarkan mobil Anda di atas.</p>
                @endforelse
            </div>
        </div>

        <!-- Right Side: Booking History -->
        <div class="lg:col-span-2 space-y-4">
            <h3 class="text-xl font-extrabold text-slate-800 tracking-tight">Riwayat Booking Servis</h3>
            
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-slate-500 text-xs font-bold uppercase tracking-widest border-b border-slate-200">
                                <th class="px-5 py-4">Mobil / Servis</th>
                                <th class="px-5 py-4">Jadwal</th>
                                <th class="px-5 py-4">Status</th>
                                <th class="px-5 py-4 text-right">Nota / Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                            @forelse($bookings as $booking)
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="px-5 py-4">
                                        <div class="text-base font-extrabold text-slate-900 mb-0.5">{{ $booking->vehicle->brand }} {{ $booking->vehicle->model }}</div>
                                        <div class="text-xs text-slate-500 font-bold">{{ $booking->service->service_name }}</div>
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <div class="text-sm text-slate-700 font-bold mb-0.5">{{ Carbon\Carbon::parse($booking->booking_date)->isoFormat('D MMM YYYY') }}</div>
                                        <div class="text-xs text-slate-400 font-medium">{{ substr($booking->booking_time, 0, 5) }} WIB</div>
                                    </td>
                                    <td class="px-5 py-4">
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
                                        @elseif($booking->status === 'Completed')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                Selesai
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-right whitespace-nowrap">
                                        @if($booking->transaction && $booking->transaction->payment && $booking->transaction->payment->payment_status === 'Paid')
                                            <a href="{{ route('invoice.print', $booking->transaction) }}" target="_blank" class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-800 text-xs font-bold rounded-lg border border-slate-200 transition">
                                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                                                <span>Cetak Nota</span>
                                            </a>
                                        @else
                                            <span class="text-xs text-slate-400 italic font-medium">Belum dibayar</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-5 py-8 text-center text-slate-500">
                                        <svg class="mx-auto h-10 w-10 text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/></svg>
                                        <span class="font-bold text-base text-slate-600">Belum ada riwayat booking servis</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
