<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Transaksi - #{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: white;
                color: black;
                padding: 0;
            }
            .print-border {
                border: none !important;
                box-shadow: none !important;
            }
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen py-10 px-4">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl border border-slate-200 shadow-sm print-border">
        <!-- Print Trigger & Back button (No Print) -->
        <div class="no-print flex items-center justify-between mb-8 pb-4 border-b border-slate-100">
            <a href="{{ route(Auth::user()->role . '.dashboard') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-800 text-sm font-medium transition">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Kembali ke Dashboard</span>
            </a>
            <button onclick="window.print()" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold rounded-xl transition shadow-md shadow-indigo-600/20 flex items-center gap-2">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Cetak Nota</span>
            </button>
        </div>

        <!-- Invoice Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b-2 border-dashed border-slate-200 pb-6 mb-6">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 bg-indigo-600 rounded-xl flex items-center justify-center font-extrabold text-white text-xl tracking-tight">
                    WM
                </div>
                <div>
                    <h1 class="text-xl font-bold tracking-tight text-slate-800 leading-none">webmobil</h1>
                    <span class="text-xs text-slate-400 font-semibold tracking-wider uppercase">Bengkel Mobil Terpercaya</span>
                </div>
            </div>
            <div class="text-left sm:text-right">
                <h2 class="text-lg font-bold text-slate-800">NOTA PEMBAYARAN</h2>
                <span class="text-xs text-slate-400 block mt-0.5">No: #{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</span>
                <span class="text-xs text-slate-400 block">Tanggal: {{ $transaction->payment ? $transaction->payment->payment_date->isoFormat('D MMMM YYYY H:mm') : $transaction->created_at->isoFormat('D MMMM YYYY H:mm') }} WIB</span>
            </div>
        </div>

        <!-- Invoice Meta Details -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm text-slate-600 mb-8">
            <div class="space-y-1">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Identitas Customer & Mobil:</h3>
                @if($transaction->booking)
                    <div class="font-bold text-slate-900">{{ $transaction->booking->user ? $transaction->booking->user->name : 'Walk-In Customer' }}</div>
                    <div>Telp: {{ $transaction->booking->user ? $transaction->booking->user->phone : '-' }}</div>
                    <div class="text-xs text-slate-500 mt-2 bg-slate-50 p-3 rounded-lg border border-slate-100">
                        <span class="font-bold text-slate-700 block">Spesifikasi Mobil:</span>
                        {{ $transaction->booking->vehicle->brand }} {{ $transaction->booking->vehicle->model }} &bull; Plat: {{ $transaction->booking->vehicle->license_plate }} &bull; Warna: {{ $transaction->booking->vehicle->color }} ({{ $transaction->booking->vehicle->year }})
                    </div>
                @else
                    <div class="font-bold text-slate-900">Direct Spareparts Sale</div>
                    <div class="text-xs text-slate-400 italic">Penjualan Langsung (Walk-In)</div>
                @endif
            </div>
            
            <div class="space-y-1 sm:text-right flex flex-col justify-between items-start sm:items-end">
                <div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Petugas Bengkel:</h3>
                    <div>Kasir: <strong class="text-slate-800">{{ $transaction->kasir ? $transaction->kasir->name : 'Staff Kasir' }}</strong></div>
                    @if($transaction->booking && $transaction->mekanik)
                        <div>Mekanik: <strong class="text-slate-800">{{ $transaction->mekanik->name }}</strong></div>
                    @endif
                </div>

                <div class="mt-4 sm:mt-0">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 uppercase tracking-wider">
                        Lunas (Paid)
                    </span>
                </div>
            </div>
        </div>

        <!-- Invoice Table -->
        <div class="border border-slate-200 rounded-xl overflow-hidden mb-8">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 text-xs font-semibold uppercase tracking-wider border-b border-slate-200">
                        <th class="px-4 py-3">Deskripsi Pekerjaan / Barang</th>
                        <th class="px-4 py-3 text-center">Harga Satuan</th>
                        <th class="px-4 py-3 text-center">Qty</th>
                        <th class="px-4 py-3 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    <!-- Service Row (If Booking) -->
                    @if($transaction->booking)
                        <tr>
                            <td class="px-4 py-4">
                                <div class="font-bold text-slate-900">Jasa Servis: {{ $transaction->booking->service->service_name }}</div>
                                <span class="text-xs text-slate-400">{{ $transaction->booking->service->description }}</span>
                            </td>
                            <td class="px-4 py-4 text-center">Rp {{ number_format($transaction->total_service, 0, ',', '.') }}</td>
                            <td class="px-4 py-4 text-center font-semibold">1</td>
                            <td class="px-4 py-4 text-right font-bold text-slate-950">Rp {{ number_format($transaction->total_service, 0, ',', '.') }}</td>
                        </tr>
                    @endif

                    <!-- Sparepart Rows -->
                    @foreach($transaction->spareparts as $item)
                        <tr>
                            <td class="px-4 py-4">
                                <div class="font-semibold text-slate-900">{{ $item->name }}</div>
                                <span class="text-xs text-slate-400">Merek: {{ $item->brand }}</span>
                            </td>
                            <td class="px-4 py-4 text-center">Rp {{ number_format($item->pivot->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-4 text-center font-semibold">{{ $item->pivot->quantity }}</td>
                            <td class="px-4 py-4 text-right font-bold text-slate-950">
                                Rp {{ number_format($item->pivot->price * $item->pivot->quantity, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total Calculation -->
        <div class="flex flex-col items-end gap-2 text-sm text-slate-600 mb-8">
            <div class="w-full sm:w-80 space-y-2">
                @if($transaction->booking)
                    <div class="flex justify-between">
                        <span>Total Jasa Servis:</span>
                        <span class="font-semibold text-slate-900">Rp {{ number_format($transaction->total_service, 0, ',', '.') }}</span>
                    </div>
                @endif
                <div class="flex justify-between">
                    <span>Total Suku Cadang:</span>
                    <span class="font-semibold text-slate-900">Rp {{ number_format($transaction->total_sparepart, 0, ',', '.') }}</span>
                </div>
                <div class="border-t border-slate-200 my-2"></div>
                <div class="flex justify-between text-base">
                    <span class="font-bold text-slate-800">Grand Total:</span>
                    <span class="font-extrabold text-indigo-600">Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}</span>
                </div>
                
                @if($transaction->payment)
                    <div class="flex justify-between">
                        <span>Dibayarkan ({{ $transaction->payment->payment_method }}):</span>
                        <span class="font-semibold text-slate-900">Rp {{ number_format($transaction->payment->amount_paid, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Uang Kembalian:</span>
                        <span class="font-bold text-emerald-600">Rp {{ number_format($transaction->payment->amount_paid - $transaction->grand_total, 0, ',', '.') }}</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Footnote / Thank you -->
        <div class="text-center border-t border-slate-200 pt-6 mt-8 space-y-1">
            <p class="text-xs text-slate-500 font-bold">Terima kasih atas kepercayaan Anda mempercayakan perawatan kendaraan di webmobil.</p>
            <p class="text-[10px] text-slate-400">Harap simpan nota ini sebagai bukti transaksi resmi Anda.</p>
        </div>
    </div>
</body>
</html>
