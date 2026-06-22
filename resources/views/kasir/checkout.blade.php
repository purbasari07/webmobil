@extends('layouts.app')

@section('title', 'Checkout Pembayaran')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <!-- Header Page -->
    <div>
        <a href="{{ route('kasir.dashboard') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-800 text-sm font-medium transition mb-2">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke dashboard</span>
        </a>
        <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Checkout Servis & Suku Cadang</h2>
        <p class="text-slate-500 text-sm mt-1">Input tambahan sparepart yang digunakan, hitung total biaya, dan terima pembayaran.</p>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Side: Detail & Sparepart input (Col span 2) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Customer & Vehicle Info -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
                <h3 class="text-base font-bold text-slate-800 tracking-tight border-b border-slate-100 pb-2">Informasi Kendaraan & Layanan</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-slate-400 block text-xs">Customer</span>
                        <strong class="text-slate-800 block mt-0.5">{{ $booking->user ? $booking->user->name : 'Walk-In Customer' }}</strong>
                        <span class="text-xs text-slate-500">{{ $booking->user ? $booking->user->phone : '-' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-xs">Mobil</span>
                        <strong class="text-slate-800 block mt-0.5">{{ $booking->vehicle->brand }} {{ $booking->vehicle->model }}</strong>
                        <span class="text-xs text-indigo-600 font-semibold">{{ $booking->vehicle->license_plate }} &bull; {{ $booking->vehicle->color }}</span>
                    </div>
                    <div class="col-span-2">
                        <span class="text-slate-400 block text-xs">Jasa Servis Utama</span>
                        <strong class="text-slate-800 block mt-0.5">{{ $booking->service->service_name }}</strong>
                        <span class="text-xs text-slate-500">Biaya Jasa: Rp {{ number_format($booking->service->price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Spareparts Section -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-6">
                <h3 class="text-base font-bold text-slate-800 tracking-tight border-b border-slate-100 pb-2">Tambahkan Suku Cadang (Sparepart)</h3>
                
                <!-- Form Add Sparepart -->
                <form action="{{ route('kasir.checkout.sparepart', $booking) }}" method="POST" class="flex flex-col sm:flex-row items-end gap-4 bg-slate-50 p-4 rounded-xl border border-slate-100">
                    @csrf
                    <div class="flex-1 w-full">
                        <label for="sparepart_id" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Pilih Sparepart</label>
                        <select name="sparepart_id" id="sparepart_id" required class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm">
                            <option value="" disabled selected>-- Pilih Sparepart --</option>
                            @foreach($spareparts as $sp)
                                <option value="{{ $sp->id }}" {{ $sp->stock === 0 ? 'disabled' : '' }}>
                                    {{ $sp->name }} (Rp {{ number_format($sp->price, 0, ',', '.') }} | Stok: {{ $sp->stock }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full sm:w-28">
                        <label for="quantity" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Jumlah (Qty)</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" required class="w-full px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm text-center">
                    </div>
                    <button type="submit" class="w-full sm:w-auto px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold rounded-xl transition shadow-sm self-stretch sm:self-auto flex items-center justify-center">
                        Tambah
                    </button>
                </form>

                <!-- List Added Spareparts -->
                <div class="space-y-4">
                    <h4 class="text-sm font-bold text-slate-700">Sparepart Terpasang</h4>
                    <div class="border border-slate-100 rounded-xl overflow-hidden">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="bg-slate-50 text-slate-500 text-xs font-semibold uppercase tracking-wider border-b border-slate-100">
                                    <th class="px-4 py-3">Nama Sparepart</th>
                                    <th class="px-4 py-3 text-center">Harga</th>
                                    <th class="px-4 py-3 text-center">Qty</th>
                                    <th class="px-4 py-3 text-center">Subtotal</th>
                                    <th class="px-4 py-3 text-right">Hapus</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-700">
                                @forelse($transaction->spareparts as $item)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="font-semibold text-slate-950">{{ $item->name }}</div>
                                            <span class="text-xs text-slate-400">{{ $item->brand }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-center">Rp {{ number_format($item->pivot->price, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 text-center font-bold">{{ $item->pivot->quantity }}</td>
                                        <td class="px-4 py-3 text-center font-bold text-slate-950">
                                            Rp {{ number_format($item->pivot->price * $item->pivot->quantity, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 text-right">
                                            <form action="{{ route('kasir.checkout.sparepart.remove', [$booking, $item->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus sparepart ini dari transaksi?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1 text-slate-400 hover:text-red-500 transition">
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-6 text-center text-slate-400 italic">
                                            Belum ada sparepart tambahan yang dimasukkan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Invoice & Payment (Col span 1) -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Ringkasan Biaya -->
            <div class="bg-slate-900 text-slate-100 p-6 rounded-2xl shadow-lg space-y-6">
                <h3 class="text-base font-bold tracking-tight border-b border-slate-800 pb-2">Ringkasan Biaya</h3>
                
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-slate-400">Biaya Jasa Servis</span>
                        <span class="font-medium text-slate-100">Rp {{ number_format($transaction->total_service, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Total Spareparts</span>
                        <span class="font-medium text-slate-100">Rp {{ number_format($transaction->total_sparepart, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t border-slate-800 my-4"></div>
                    <div class="flex justify-between items-baseline">
                        <span class="text-base font-bold text-slate-300">Grand Total</span>
                        <span class="text-2xl font-extrabold text-white tracking-tight">Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Proses Pembayaran -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
                <h3 class="text-base font-bold text-slate-800 tracking-tight border-b border-slate-100 pb-2">Proses Pelunasan</h3>
                
                <form action="{{ route('kasir.checkout.pay', $booking) }}" method="POST" class="space-y-4" id="payment-form">
                    @csrf
                    <div>
                        <label for="payment_method" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Metode Pembayaran</label>
                        <select name="payment_method" id="payment_method" required class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-sm">
                            <option value="Cash">Tunai (Cash)</option>
                            <option value="Transfer">Transfer Bank</option>
                            <option value="QRIS">QRIS / E-Wallet</option>
                        </select>
                    </div>

                    <div>
                        <label for="amount_paid" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Jumlah Uang Dibayar (Rp)</label>
                        <input type="number" name="amount_paid" id="amount_paid" required min="{{ $transaction->grand_total }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 font-bold focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition text-base" placeholder="Masukkan jumlah bayar">
                        @error('amount_paid')
                            <p class="text-xs text-rose-500 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Calculator kembalian -->
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-slate-500">Total Tagihan:</span>
                            <span class="font-bold text-slate-800">Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500">Uang Kembali:</span>
                            <span class="font-extrabold text-indigo-600" id="change-amount">Rp 0</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl transition shadow-lg shadow-emerald-600/20 text-sm flex items-center justify-center gap-2">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Selesaikan Pembayaran</span>
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    const grandTotal = {{ $transaction->grand_total }};
    const amountPaidInput = document.getElementById('amount_paid');
    const changeAmountDisplay = document.getElementById('change-amount');

    amountPaidInput.addEventListener('input', function() {
        const paid = parseFloat(amountPaidInput.value) || 0;
        const change = paid - grandTotal;
        
        if (change >= 0) {
            changeAmountDisplay.innerText = "Rp " + change.toLocaleString('id-ID');
            changeAmountDisplay.className = "font-extrabold text-emerald-600";
        } else {
            changeAmountDisplay.innerText = "Kurang Rp " + Math.abs(change).toLocaleString('id-ID');
            changeAmountDisplay.className = "font-extrabold text-rose-600";
        }
    });
</script>
@endsection
