<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan Bengkel</title>
    <!-- Use Tailwind CSS CDN for elegant layouts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body {
                background-color: white;
                color: black;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 p-8">

    <!-- Top Action bar (Non-printable) -->
    <div class="no-print max-w-6xl mx-auto mb-8 flex justify-between items-center bg-white p-4 rounded-xl shadow-sm border border-slate-200">
        <span class="text-sm font-medium text-slate-500">Pratinjau Cetak Laporan Keuangan</span>
        <div class="flex gap-3">
            <button onclick="window.print()" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg shadow-sm transition-colors text-sm">
                Cetak / Simpan PDF
            </button>
            <a href="{{ route('owner.dashboard') }}" class="px-5 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold rounded-lg transition-colors text-sm">
                Kembali ke Dashboard
            </a>
        </div>
    </div>

    <!-- Printable Content Container -->
    <div class="max-w-6xl mx-auto bg-white p-10 rounded-2xl shadow-sm border border-slate-200">
        <!-- Logo / Header -->
        <div class="flex justify-between items-start border-b border-slate-200 pb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-950 tracking-tight">BENGKELKU</h1>
                <p class="text-sm text-slate-500 mt-1">Laporan Keuangan & Transaksi Lunas</p>
            </div>
            <div class="text-right text-sm text-slate-500 space-y-1">
                <p class="font-bold text-slate-800">Perihal: Laporan Pendapatan</p>
                <p>Periode: <strong>{{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }}</strong> s/d <strong>{{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</strong></p>
                <p>Dicetak pada: {{ now()->format('d-m-Y H:i') }}</p>
            </div>
        </div>

        <!-- Summary Cards Grid -->
        <div class="grid grid-cols-3 gap-6 my-8">
            <div class="bg-slate-50 p-5 rounded-xl border border-slate-200 space-y-1">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Pendapatan Jasa Service</span>
                <div class="text-xl font-extrabold text-slate-900">Rp {{ number_format($totalService, 0, ',', '.') }}</div>
            </div>
            <div class="bg-slate-50 p-5 rounded-xl border border-slate-200 space-y-1">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Pendapatan Sparepart</span>
                <div class="text-xl font-extrabold text-slate-900">Rp {{ number_format($totalSparepart, 0, ',', '.') }}</div>
            </div>
            <div class="bg-indigo-50/50 p-5 rounded-xl border border-indigo-100 space-y-1">
                <span class="text-xs font-semibold text-indigo-600 uppercase tracking-wider">Total Omset Keseluruhan</span>
                <div class="text-xl font-extrabold text-indigo-900">Rp {{ number_format($totalGrand, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- Table Data -->
        <div class="space-y-4">
            <h3 class="text-lg font-bold text-slate-800 tracking-tight">Rincian Transaksi Masuk</h3>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50 text-slate-600 font-semibold">
                            <th class="py-3.5 px-4 text-center">No</th>
                            <th class="py-3.5 px-4">Tanggal</th>
                            <th class="py-3.5 px-4">Pelanggan</th>
                            <th class="py-3.5 px-4">Mobil</th>
                            <th class="py-3.5 px-4">Mekanik</th>
                            <th class="py-3.5 px-4 text-right">Jasa Service</th>
                            <th class="py-3.5 px-4 text-right">Sparepart</th>
                            <th class="py-3.5 px-4 text-right">Total</th>
                            <th class="py-3.5 px-4 text-center">Metode</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($payments as $index => $payment)
                            @php
                                $transaction = $payment->transaction;
                                $booking = $transaction?->booking;
                                $customerName = $booking?->vehicle?->user?->name ?? 'Walk-in';
                                $vehicleName = $booking?->vehicle ? ($booking->vehicle->brand . ' ' . $booking->vehicle->model) : '-';
                                $mekanikName = $transaction?->mekanik?->name ?? '-';
                            @endphp
                            <tr class="hover:bg-slate-50/50">
                                <td class="py-3 px-4 text-center text-slate-400 font-medium">{{ $index + 1 }}</td>
                                <td class="py-3 px-4 text-slate-600 font-medium whitespace-nowrap">{{ $payment->payment_date->format('d-m-Y H:i') }}</td>
                                <td class="py-3 px-4 font-bold text-slate-850">{{ $customerName }}</td>
                                <td class="py-3 px-4 text-slate-600">{{ $vehicleName }}</td>
                                <td class="py-3 px-4 text-slate-500 font-medium">{{ $mekanikName }}</td>
                                <td class="py-3 px-4 text-right text-slate-600">Rp {{ number_format($transaction?->total_service ?? 0, 0, ',', '.') }}</td>
                                <td class="py-3 px-4 text-right text-slate-600">Rp {{ number_format($transaction?->total_sparepart ?? 0, 0, ',', '.') }}</td>
                                <td class="py-3 px-4 text-right font-extrabold text-slate-900">Rp {{ number_format($payment->amount_paid, 0, ',', '.') }}</td>
                                <td class="py-3 px-4 text-center">
                                    <span class="px-2.5 py-1 bg-slate-100 text-slate-700 rounded-lg text-xs font-bold">{{ $payment->payment_method }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="py-8 text-center text-slate-400 italic">Belum ada transaksi dalam rentang tanggal ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer Signatures -->
        <div class="grid grid-cols-2 gap-12 mt-16 pt-8 border-t border-slate-100 text-center text-sm text-slate-500">
            <div></div>
            <div class="space-y-16">
                <div>
                    <p>Mengetahui,</p>
                    <p class="font-bold text-slate-800">Owner Bengkelku</p>
                </div>
                <div>
                    <div class="w-48 border-b border-slate-300 mx-auto"></div>
                    <p class="mt-2 text-xs">Tanda tangan & Nama Terang</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Automatically trigger printing when printable is focused/ready -->
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            // Auto open print dialog
            setTimeout(() => {
                window.print();
            }, 500);
        });
    </script>
</body>
</html>
