@extends('layouts.app')

@section('title', 'Booking Offline')

@section('content')
<div class="max-w-6xl mx-auto space-y-8">
    <!-- Header Page -->
    <div>
        <a href="{{ route('kasir.dashboard') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-800 text-sm font-medium transition mb-2">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke dashboard</span>
        </a>
        <h2 class="text-4xl font-extrabold text-slate-800 tracking-tight">Pendaftaran Booking Offline</h2>
        <p class="text-slate-500 text-lg mt-2 font-medium">Daftarkan customer langsung (walk-in) dan masukkan ke tabel antrean mekanik.</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 sm:p-12">
        <form action="{{ route('kasir.booking.offline.store') }}" method="POST" class="space-y-10">
            @csrf
            
            <!-- SECTION 1: CUSTOMER DATA -->
            <div class="space-y-6">
                <h3 class="text-2xl font-extrabold text-slate-800 tracking-tight border-b border-slate-100 pb-4">1. Data Customer</h3>
                
                <div>
                    <label class="block text-sm font-bold text-slate-500 uppercase tracking-wider mb-3">Jenis Customer</label>
                    <div class="flex items-center gap-8">
                        <label class="flex items-center">
                            <input type="radio" name="customer_type" value="new" checked onclick="toggleCustomerType('new')" class="h-5 w-5 text-indigo-600 focus:ring-indigo-500 border-slate-300">
                            <span class="ml-3 text-base text-slate-700 font-bold">Customer Baru</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="customer_type" value="existing" onclick="toggleCustomerType('existing')" class="h-5 w-5 text-indigo-600 focus:ring-indigo-500 border-slate-300">
                            <span class="ml-3 text-base text-slate-700 font-bold">Customer Lama (Terdaftar)</span>
                        </label>
                    </div>
                </div>

                <!-- Existing Customer Input -->
                <div id="existing_customer_fields" class="hidden">
                    <label for="user_id" class="block text-sm font-bold text-slate-500 uppercase tracking-wider mb-3">Pilih Customer Lama</label>
                    <select name="user_id" id="user_id" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-base font-medium">
                        <option value="" disabled selected>-- Pilih Customer --</option>
                        @foreach($customers as $cust)
                            <option value="{{ $cust->id }}">{{ $cust->name }} ({{ $cust->phone }} - {{ $cust->email }})</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="text-sm text-rose-500 mt-2 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Customer Input Fields -->
                <div id="new_customer_fields" class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-bold text-slate-500 uppercase tracking-wider mb-3">Nama Lengkap</label>
                        <input type="text" name="name" id="name" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-base font-medium" placeholder="Contoh: Budi Santoso">
                        @error('name')
                            <p class="text-sm text-rose-500 mt-2 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-bold text-slate-500 uppercase tracking-wider mb-3">Nomor Telepon / WA</label>
                        <input type="text" name="phone" id="phone" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-base font-medium" placeholder="0812XXXXXXXX">
                        @error('phone')
                            <p class="text-sm text-rose-500 mt-2 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-bold text-slate-500 uppercase tracking-wider mb-3">Alamat Lengkap</label>
                        <textarea name="address" id="address" rows="3" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-base font-medium resize-none" placeholder="Masukkan alamat lengkap..."></textarea>
                        @error('address')
                            <p class="text-sm text-rose-500 mt-2 font-bold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- SECTION 2: VEHICLE DATA -->
            <div class="space-y-6">
                <h3 class="text-2xl font-extrabold text-slate-800 tracking-tight border-b border-slate-100 pb-4">2. Data Mobil</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <div>
                        <label for="brand" class="block text-sm font-bold text-slate-500 uppercase tracking-wider mb-3">Merek Kendaraan</label>
                        <input type="text" name="brand" id="brand" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-base font-medium" placeholder="Contoh: Honda">
                    </div>
                    <div>
                        <label for="model" class="block text-sm font-bold text-slate-500 uppercase tracking-wider mb-3">Model / Seri</label>
                        <input type="text" name="model" id="model" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-base font-medium" placeholder="Contoh: Jazz">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                    <div>
                        <label for="year" class="block text-sm font-bold text-slate-500 uppercase tracking-wider mb-3">Tahun Pembuatan</label>
                        <input type="number" name="year" id="year" required min="1900" max="{{ date('Y')+1 }}" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-base font-medium" placeholder="2018">
                    </div>
                    <div>
                        <label for="color" class="block text-sm font-bold text-slate-500 uppercase tracking-wider mb-3">Warna Kendaraan</label>
                        <input type="text" name="color" id="color" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-base font-medium" placeholder="Contoh: Putih">
                    </div>
                    <div>
                        <label for="license_plate" class="block text-sm font-bold text-slate-500 uppercase tracking-wider mb-3">Nomor Polisi (Plat)</label>
                        <input type="text" name="license_plate" id="license_plate" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-base font-medium" placeholder="Contoh: D 1234 XY">
                    </div>
                </div>
            </div>

            <!-- SECTION 3: BOOKING DETAILS -->
            <div class="space-y-6">
                <h3 class="text-2xl font-extrabold text-slate-800 tracking-tight border-b border-slate-100 pb-4">3. Detail Booking Servis</h3>
                
                <div>
                    <label for="service_id" class="block text-sm font-bold text-slate-500 uppercase tracking-wider mb-3">Pilih Layanan Utama</label>
                    <select name="service_id" id="service_id" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-base font-medium">
                        <option value="" disabled selected>-- Pilih Layanan --</option>
                        @foreach($services as $srv)
                            <option value="{{ $srv->id }}">{{ $srv->service_name }} (Rp {{ number_format($srv->price, 0, ',', '.') }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <div>
                        <label for="booking_date" class="block text-sm font-bold text-slate-500 uppercase tracking-wider mb-3">Tanggal Masuk</label>
                        <input type="date" name="booking_date" id="booking_date" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-base font-medium">
                    </div>
                    <div>
                        <label for="booking_time" class="block text-sm font-bold text-slate-500 uppercase tracking-wider mb-3">Waktu Masuk</label>
                        <select name="booking_time" id="booking_time" required class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-base font-medium">
                            <option value="" disabled>-- Pilih Jam --</option>
                            <option value="08:00" selected>08:00 WIB</option>
                            <option value="09:00">09:00 WIB</option>
                            <option value="10:00">10:00 WIB</option>
                            <option value="11:00">11:00 WIB</option>
                            <option value="13:00">13:00 WIB</option>
                            <option value="14:00">14:00 WIB</option>
                            <option value="15:00">15:00 WIB</option>
                            <option value="16:00">16:00 WIB</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="complaint" class="block text-sm font-bold text-slate-500 uppercase tracking-wider mb-3">Keluhan / Catatan</label>
                    <textarea name="complaint" id="complaint" rows="3" class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-base font-medium resize-none" placeholder="Contoh: Bunyi berdecit di rem belakang, ganti oli sekalian..."></textarea>
                </div>
            </div>

            <!-- Submit buttons -->
            <div class="flex items-center justify-end gap-6 border-t border-slate-100 pt-8">
                <a href="{{ route('kasir.dashboard') }}" class="px-8 py-4 bg-white hover:bg-slate-50 text-slate-700 text-base font-bold rounded-2xl border border-slate-200 transition">
                    Batal
                </a>
                <button type="submit" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-500 text-white text-base font-bold rounded-2xl transition shadow-lg shadow-indigo-600/30">
                    Daftarkan Antrean
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleCustomerType(type) {
        var newFields = document.getElementById('new_customer_fields');
        var existingFields = document.getElementById('existing_customer_fields');
        var nameInput = document.getElementById('name');
        var phoneInput = document.getElementById('phone');
        var addressInput = document.getElementById('address');
        var selectVal = document.getElementById('user_id');

        if (type === 'existing') {
            newFields.classList.add('hidden');
            existingFields.classList.remove('hidden');
            nameInput.removeAttribute('required');
            phoneInput.removeAttribute('required');
            addressInput.removeAttribute('required');
            selectVal.setAttribute('required', 'required');
        } else {
            newFields.classList.remove('hidden');
            existingFields.classList.add('hidden');
            nameInput.setAttribute('required', 'required');
            phoneInput.setAttribute('required', 'required');
            addressInput.setAttribute('required', 'required');
            selectVal.removeAttribute('required');
        }
    }
</script>
@endsection
