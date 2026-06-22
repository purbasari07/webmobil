@extends('layouts.app')

@section('title', 'Buat Booking Servis')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <!-- Header Page -->
    <div>
        <a href="{{ route('customer.dashboard') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-800 text-sm font-medium transition mb-2">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke dashboard</span>
        </a>
        <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Booking Servis Online</h2>
        <p class="text-slate-500 text-sm mt-1">Jadwalkan perbaikan atau perawatan berkala mobil Anda.</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <form action="{{ route('customer.booking.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Select Vehicle -->
            <div>
                <label for="vehicle_id" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Pilih Mobil</label>
                <select name="vehicle_id" id="vehicle_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm">
                    <option value="" disabled selected>-- Pilih Mobil Terdaftar --</option>
                    @foreach($vehicles as $veh)
                        <option value="{{ $veh->id }}">{{ $veh->brand }} {{ $veh->model }} ({{ $veh->license_plate }})</option>
                    @endforeach
                </select>
                @error('vehicle_id')
                    <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Select Service -->
            <div>
                <label for="service_id" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Pilih Layanan Utama</label>
                <select name="service_id" id="service_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm">
                    <option value="" disabled selected>-- Pilih Jenis Layanan --</option>
                    @foreach($services as $srv)
                        <option value="{{ $srv->id }}">{{ $srv->service_name }} (Rp {{ number_format($srv->price, 0, ',', '.') }})</option>
                    @endforeach
                </select>
                @error('service_id')
                    <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Booking Date and Time -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="booking_date" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Tanggal Kedatangan</label>
                    <input type="date" name="booking_date" id="booking_date" min="{{ date('Y-m-d') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm">
                    @error('booking_date')
                        <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="booking_time" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Waktu Kedatangan</label>
                    <select name="booking_time" id="booking_time" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm">
                        <option value="" disabled selected>-- Pilih Jam --</option>
                        <option value="08:00">08:00 WIB</option>
                        <option value="09:00">09:00 WIB</option>
                        <option value="10:00">10:00 WIB</option>
                        <option value="11:00">11:00 WIB</option>
                        <option value="13:00">13:00 WIB</option>
                        <option value="14:00">14:00 WIB</option>
                        <option value="15:00">15:00 WIB</option>
                        <option value="16:00">16:00 WIB</option>
                    </select>
                    @error('booking_time')
                        <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Complaint -->
            <div>
                <label for="complaint" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Keluhan / Catatan Tambahan</label>
                <textarea name="complaint" id="complaint" rows="4" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm resize-none" placeholder="Contoh: Bunyi berdecit di rem depan saat mengerem, atau sekedar servis berkala..."></textarea>
                @error('complaint')
                    <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end gap-4 border-t border-slate-100 pt-6">
                <a href="{{ route('customer.dashboard') }}" class="px-5 py-3 bg-white hover:bg-slate-50 text-slate-700 text-sm font-semibold rounded-xl border border-slate-200 transition">
                    Batal
                </a>
                <button type="submit" class="px-5 py-3 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold rounded-xl transition shadow-md shadow-indigo-600/20">
                    Ajukan Booking
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
