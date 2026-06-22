@extends('layouts.app')

@section('title', 'Owner Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Header Page -->
    <div>
        <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Laporan & Analisis Bengkel</h2>
        <p class="text-slate-500 text-sm mt-1">Pantau grafik omzet harian/bulanan, performa pelayanan servis mekanik, dan statistik penjualan sparepart secara real-time.</p>
    </div>



    <!-- Laporan Keuangan Summary Cards (Single Main Row - White Cards) -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Card 1: Total Pendapatan (Filtered) -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between hover:scale-[1.02] transition-all duration-300">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Pendapatan</span>
                <span class="p-2.5 bg-indigo-50 text-indigo-650 rounded-xl">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
            </div>
            <div class="mt-4">
                <span class="text-2xl font-extrabold text-slate-900 tracking-tight">Rp {{ number_format($totalGrandRevenue, 0, ',', '.') }}</span>
                <span class="text-xs text-slate-450 block mt-1">Gabungan (Sparepart + Service)</span>
            </div>
        </div>

        <!-- Card 2: Jasa Service (Filtered) -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between hover:scale-[1.02] transition-all duration-300">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Pendapatan Jasa Service</span>
                <span class="p-2.5 bg-sky-50 text-sky-650 rounded-xl">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </span>
            </div>
            <div class="mt-4">
                <span class="text-2xl font-extrabold text-slate-900 tracking-tight">Rp {{ number_format($totalServiceRevenue, 0, ',', '.') }}</span>
                <span class="text-xs text-slate-450 block mt-1">Total jasa service & perawatan</span>
            </div>
        </div>

        <!-- Card 3: Sparepart (Filtered) -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between hover:scale-[1.02] transition-all duration-300">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Pendapatan Sparepart</span>
                <span class="p-2.5 bg-emerald-50 text-emerald-650 rounded-xl">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </span>
            </div>
            <div class="mt-4">
                <span class="text-2xl font-extrabold text-slate-900 tracking-tight">Rp {{ number_format($totalSparepartRevenue, 0, ',', '.') }}</span>
                <span class="text-xs text-slate-450 block mt-1">Total penjualan suku cadang</span>
            </div>
        </div>

        <!-- Card 4: Omzet Hari Ini -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between hover:scale-[1.02] transition-all duration-300">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Omzet Hari Ini</span>
                <span class="p-2.5 bg-amber-50 text-amber-650 rounded-xl">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10a2 2 0 01-2 2h-2a2 2 0 01-2-2zm0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </span>
            </div>
            <div class="mt-4">
                <span class="text-2xl font-extrabold text-slate-900 tracking-tight">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</span>
                <span class="text-xs text-slate-450 block mt-1">Pendapatan lunas hari ini</span>
            </div>
        </div>
    </div>

    <!-- Operational Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Card Completed Bookings -->
        <div class="bg-white px-6 py-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Servis Selesai</span>
                <div class="text-2xl font-extrabold text-slate-900">{{ $completedBookings }} Unit Mobil</div>
            </div>
            <span class="p-3 bg-sky-50 text-sky-600 rounded-xl">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            </span>
        </div>

        <!-- Card Active Queue -->
        <div class="bg-white px-6 py-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Antrean Aktif Saat Ini</span>
                <div class="text-2xl font-extrabold text-slate-900">{{ $activeQueue }} Kendaraan</div>
            </div>
            <span class="p-3 bg-amber-50 text-amber-600 rounded-xl">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </span>
        </div>
    </div>

    <!-- Charts Grid (Daily & Monthly Revenue) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Daily Revenue Chart -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <h3 class="text-lg font-bold text-slate-800 tracking-tight mb-4">Grafik Omzet Harian (7 Hari Terakhir)</h3>
            <div class="h-80 w-full">
                <canvas id="dailyChart"></canvas>
            </div>
        </div>

        <!-- Monthly Revenue Chart -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <h3 class="text-lg font-bold text-slate-800 tracking-tight mb-4">Grafik Omzet Bulanan (6 Bulan Terakhir)</h3>
            <div class="h-80 w-full">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Analytics Tables Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Popular Services -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
            <h3 class="text-base font-bold text-slate-800 tracking-tight border-b border-slate-100 pb-2">Servis Paling Laris</h3>
            <div class="space-y-3">
                @forelse($popularServices as $srv)
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-slate-700 font-medium truncate max-w-[200px]">{{ $srv->service_name }}</span>
                        <span class="px-2.5 py-1 bg-slate-100 text-slate-700 font-bold rounded-lg">{{ $srv->count }}x booking</span>
                    </div>
                @empty
                    <p class="text-xs text-slate-400 italic text-center py-6">Belum ada data servis populer.</p>
                @endforelse
            </div>
        </div>

        <!-- Top Selling Spareparts -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
            <h3 class="text-base font-bold text-slate-800 tracking-tight border-b border-slate-100 pb-2">Suku Cadang Terlaris</h3>
            <div class="space-y-3">
                @forelse($topSpareparts as $part)
                    <div class="flex items-center justify-between text-sm">
                        <div>
                            <span class="text-slate-700 font-medium block truncate max-w-[180px]">{{ $part->name }}</span>
                            <span class="text-[10px] text-slate-400 block">{{ $part->brand }}</span>
                        </div>
                        <span class="px-2.5 py-1 bg-slate-100 text-slate-700 font-bold rounded-lg">{{ (int)$part->sold_count }} unit</span>
                    </div>
                @empty
                    <p class="text-xs text-slate-400 italic text-center py-6">Belum ada data sparepart terjual.</p>
                @endforelse
            </div>
        </div>

        <!-- Mechanic Performance -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
            <h3 class="text-base font-bold text-slate-800 tracking-tight border-b border-slate-100 pb-2">Performa Kerja Mekanik</h3>
            <div class="space-y-3">
                @forelse($mechanicPerf as $mek)
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-slate-700 font-medium">{{ $mek->name }}</span>
                        <span class="px-2.5 py-1 bg-slate-100 text-slate-700 font-bold rounded-lg">{{ $mek->jobs_count }} pekerjaan</span>
                    </div>
                @empty
                    <p class="text-xs text-slate-400 italic text-center py-6">Belum ada pengerjaan dari mekanik.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Load Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 1. Daily Chart Configuration
    const dailyCtx = document.getElementById('dailyChart').getContext('2d');
    const dailyChart = new Chart(dailyCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($dailyLabels) !!},
            datasets: [{
                label: 'Omzet Harian (Rupiah)',
                data: {!! json_encode($dailyValues) !!},
                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                borderColor: 'rgb(99, 102, 241)',
                borderWidth: 3,
                fill: true,
                tension: 0.3,
                pointBackgroundColor: 'rgb(99, 102, 241)',
                pointRadius: 4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });

    // 2. Monthly Chart Configuration
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    const monthlyChart = new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($monthlyLabels) !!},
            datasets: [{
                label: 'Omzet Bulanan (Rupiah)',
                data: {!! json_encode($monthlyValues) !!},
                backgroundColor: 'rgba(14, 165, 233, 0.85)',
                borderColor: 'rgb(14, 165, 233)',
                borderRadius: 8,
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
