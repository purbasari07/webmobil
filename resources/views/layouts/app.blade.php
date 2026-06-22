<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Webmobil') - Bengkel Digital</title>
    <!-- Google Fonts: Outfit & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.875rem; /* Set base font size smaller */
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full text-sm">
    <div class="min-h-full flex flex-col md:flex-row">
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-900 text-slate-100 flex flex-col shrink-0">
            <!-- Sidebar Header -->
            <div class="p-4 border-b border-slate-800 flex items-center gap-3">
                <div class="h-8 w-8 bg-indigo-600 rounded-lg flex items-center justify-center font-extrabold text-white text-base tracking-tight shadow-lg shadow-indigo-500/30">
                    WM
                </div>
                <div>
                    <h1 class="text-base font-bold tracking-tight text-white leading-none mb-1">webmobil</h1>
                    <span class="text-[10px] text-indigo-400 font-semibold tracking-wider uppercase">Sistem Bengkel</span>
                </div>
            </div>

            <!-- Sidebar Navigation -->
            <nav class="flex-1 p-3 space-y-1 overflow-y-auto">
                @if(Auth::check())
                    <!-- ADMIN SIDEBAR -->
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg transition {{ Route::is('admin.dashboard') ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30 text-xs' : 'text-slate-400 font-medium hover:bg-slate-800 hover:text-slate-100 text-xs' }}">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"/></svg>
                            <span>Dashboard</span>
                        </a>
                        <a href="{{ route('admin.services.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg transition {{ Route::is('admin.services.*') ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30 text-xs' : 'text-slate-400 font-medium hover:bg-slate-800 hover:text-slate-100 text-xs' }}">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>Layanan Servis</span>
                        </a>
                        <a href="{{ route('admin.spareparts.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg transition {{ Route::is('admin.spareparts.*') ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30 text-xs' : 'text-slate-400 font-medium hover:bg-slate-800 hover:text-slate-100 text-xs' }}">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            <span>Stok Sparepart</span>
                        </a>
                    @endif

                    <!-- KASIR SIDEBAR -->
                    @if(Auth::user()->role === 'kasir')
                        <a href="{{ route('kasir.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg transition {{ Route::is('kasir.dashboard') || Route::is('kasir.checkout') ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30 text-xs' : 'text-slate-400 font-medium hover:bg-slate-800 hover:text-slate-100 text-xs' }}">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                            <span>Dashboard & Antrean</span>
                        </a>
                        <a href="{{ route('kasir.booking.offline') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg transition {{ Route::is('kasir.booking.offline') ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30 text-xs' : 'text-slate-400 font-medium hover:bg-slate-800 hover:text-slate-100 text-xs' }}">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                            <span>Booking Offline</span>
                        </a>
                        <a href="{{ route('kasir.direct-sale') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg transition {{ Route::is('kasir.direct-sale') ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30 text-xs' : 'text-slate-400 font-medium hover:bg-slate-800 hover:text-slate-100 text-xs' }}">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            <span>Penjualan Langsung</span>
                        </a>
                    @endif

                    <!-- MEKANIK SIDEBAR -->
                    @if(Auth::user()->role === 'mekanik')
                        <a href="{{ route('mekanik.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg transition {{ Route::is('mekanik.dashboard') ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30 text-xs' : 'text-slate-400 font-medium hover:bg-slate-800 hover:text-slate-100 text-xs' }}">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Antrean Mekanik</span>
                        </a>
                    @endif

                    <!-- OWNER SIDEBAR -->
                    @if(Auth::user()->role === 'owner')
                        <a href="{{ route('owner.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg transition {{ Route::is('owner.dashboard') ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30 text-xs' : 'text-slate-400 font-medium hover:bg-slate-800 hover:text-slate-100 text-xs' }}">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10a2 2 0 01-2 2h-2a2 2 0 01-2-2zm0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            <span>Laporan Performansi</span>
                        </a>
                    @endif

                    <!-- CUSTOMER SIDEBAR -->
                    @if(Auth::user()->role === 'customer')
                        <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg transition {{ Route::is('customer.dashboard') ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-600/30 text-xs' : 'text-slate-400 font-medium hover:bg-slate-800 hover:text-slate-100 text-xs' }}">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            <span>Dashboard Mobilku</span>
                        </a>
                    @endif
                @endif
            </nav>

            <!-- Sidebar Footer / User Profile info -->
            @if(Auth::check())
                <div class="p-3 border-t border-slate-800 bg-slate-950/40">
                    <div class="flex items-center gap-2">
                        <div class="h-8 w-8 rounded-full bg-slate-700 flex items-center justify-center font-bold text-slate-200 text-sm">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <h2 class="text-xs font-bold text-slate-100 truncate">{{ Auth::user()->name }}</h2>
                            <p class="text-[10px] text-indigo-400 font-semibold capitalize">{{ Auth::user()->role }}</p>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit" class="w-full py-1.5 px-2 bg-slate-800 text-slate-300 text-[10px] font-bold rounded hover:bg-red-600 hover:text-white transition flex items-center justify-center gap-1.5">
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            @endif
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col min-w-0">
            <!-- Top Bar Header -->
            <header class="bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="text-sm font-bold text-slate-500">
                        {{ Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}
                    </div>
                </div>
                
                <div class="flex items-center gap-3">
                    <!-- Role badge -->
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-extrabold bg-indigo-50 text-indigo-700 border border-indigo-200 uppercase">
                        {{ Auth::user()->role }} Portal
                    </span>
                </div>
            </header>

            <!-- Page Body -->
            <div class="flex-1 p-6 overflow-y-auto">
                <!-- Session Alert -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl flex items-center gap-3 text-sm">
                        <svg class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="font-bold">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl flex items-center gap-3 text-sm">
                        <svg class="h-5 w-5 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="font-bold">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
