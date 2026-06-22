<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>webmobil - Bengkel Digital</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#0f1115] text-white min-h-screen flex flex-col selection:bg-purple-500 selection:text-white">

    <!-- Navbar -->
    <header class="w-full fixed top-0 z-50 bg-[#0f1115]/80 backdrop-blur-xl border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            <!-- Logo -->
            <a href="#" class="flex items-center gap-3 hover:opacity-80 transition">
                <div class="h-8 w-8 bg-purple-600 rounded-lg flex items-center justify-center font-bold text-white text-lg shadow-lg shadow-purple-600/30">
                    WM
                </div>
                <h1 class="text-xl font-extrabold tracking-tight">webmobil</h1>
            </a>

            <!-- Menu Desktop -->
            <nav class="hidden md:flex items-center gap-8">
                <a href="#hero" class="text-sm font-bold text-slate-300 hover:text-white transition">Beranda</a>
                <a href="#layanan" class="text-sm font-bold text-slate-300 hover:text-white transition">Layanan</a>
                <a href="#keunggulan" class="text-sm font-bold text-slate-300 hover:text-white transition">Keunggulan</a>
                <a href="#testimoni" class="text-sm font-bold text-slate-300 hover:text-white transition">Testimoni</a>
            </nav>

            <!-- Auth -->
            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        @php
                            $dashboardRoute = 'customer.dashboard';
                            if (Auth::user()->role === 'admin') $dashboardRoute = 'admin.dashboard';
                            elseif (Auth::user()->role === 'kasir') $dashboardRoute = 'kasir.dashboard';
                            elseif (Auth::user()->role === 'mekanik') $dashboardRoute = 'mekanik.dashboard';
                            elseif (Auth::user()->role === 'owner') $dashboardRoute = 'owner.dashboard';
                        @endphp
                        <a href="{{ route($dashboardRoute) }}" class="text-sm font-bold text-purple-400 hover:text-purple-300 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-slate-300 hover:text-white transition hidden sm:inline-block">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2 bg-purple-600 hover:bg-purple-500 text-white text-sm font-bold rounded-lg transition shadow-md shadow-purple-600/30">Daftar Akun</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <main class="flex-grow pt-16">
        <!-- Hero Section -->
        <section id="hero" class="relative px-6 max-w-7xl mx-auto flex flex-col items-center justify-center text-center" style="padding-top: 160px; padding-bottom: 160px; margin-top: 32px;">
            <!-- Glow -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-purple-600/20 rounded-full blur-[120px] -z-10 pointer-events-none" style="width: 600px; height: 600px;"></div>

            <div class="inline-flex items-center bg-white/5 border border-white/10 rounded-full text-slate-300 backdrop-blur-sm" style="padding: 8px 20px; gap: 8px; font-size: 14px; font-weight: 600; margin-bottom: 32px;">
                <span class="rounded-full bg-purple-500 animate-pulse" style="width: 10px; height: 10px;"></span>
                Sistem Manajemen Bengkel Era Baru
            </div>

            <h1 class="font-extrabold tracking-tight max-w-4xl mx-auto" style="font-size: 4.5rem; line-height: 1.1; margin-bottom: 24px;">
                Servis Mobil, 
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-fuchsia-400 to-purple-400">Lebih Sederhana.</span>
            </h1>
            
            <p class="text-slate-400 max-w-2xl mx-auto" style="font-size: 1.25rem; line-height: 1.6; margin-bottom: 40px;">
                Platform bengkel digital untuk booking antrean, pantauan perbaikan mekanik, dan invoice otomatis dalam satu genggaman.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center" style="gap: 16px;">
                @auth
                    <a href="{{ route('customer.booking.create') }}" class="bg-white text-black hover:bg-slate-200 font-extrabold rounded-2xl transition shadow-[0_0_20px_rgba(255,255,255,0.15)]" style="padding: 16px 32px; font-size: 1.125rem;">
                        Booking Jadwal Servis
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-purple-600 hover:bg-purple-500 text-white font-extrabold rounded-2xl transition shadow-[0_0_20px_rgba(147,51,234,0.4)]" style="padding: 16px 32px; font-size: 1.125rem;">
                        Mulai Booking Sekarang
                    </a>
                @endauth
                <a href="#layanan" class="bg-white/5 hover:bg-white/10 border border-white/10 text-white font-extrabold rounded-2xl transition backdrop-blur-md" style="padding: 16px 32px; font-size: 1.125rem;">
                    Lihat Layanan
                </a>
            </div>
        </section>

        <!-- Layanan Section -->
        <section id="layanan" style="padding: 80px 24px; background: #0a0b0e; border-top: 1px solid rgba(255,255,255,0.05);">
            <div style="max-width: 1100px; margin: 0 auto;">
                <div style="text-align: center; max-width: 600px; margin: 0 auto 56px;">
                    <h2 style="font-size: 2rem; font-weight: 800; color: #fff; margin-bottom: 12px;">Layanan Profesional</h2>
                    <p style="color: #94a3b8; font-size: 0.95rem; line-height: 1.7;">Solusi perawatan kendaraan paripurna. Tim mekanik kami siap membantu merawat mobil Anda agar selalu dalam kondisi prima.</p>
                </div>

                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
                    <!-- Service 1 -->
                    <div style="padding: 32px; background: #0f1115; border: 1px solid rgba(255,255,255,0.06); border-radius: 20px;">
                        <div style="width: 52px; height: 52px; background: rgba(168,85,247,0.1); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: #a78bfa; margin-bottom: 20px;">
                            <svg style="width:26px;height:26px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <h3 style="font-size: 1.1rem; font-weight: 700; color: #fff; margin-bottom: 10px;">Servis Berkala</h3>
                        <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.7;">Penggantian oli, filter udara, pengecekan busi, dan pemeliharaan standar untuk menjaga mesin tetap sehat.</p>
                    </div>
                    <!-- Service 2 -->
                    <div style="padding: 32px; background: #0f1115; border: 1px solid rgba(255,255,255,0.06); border-radius: 20px;">
                        <div style="width: 52px; height: 52px; background: rgba(168,85,247,0.1); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: #a78bfa; margin-bottom: 20px;">
                            <svg style="width:26px;height:26px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h3 style="font-size: 1.1rem; font-weight: 700; color: #fff; margin-bottom: 10px;">Tune Up Mesin</h3>
                        <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.7;">Kalibrasi ulang mesin, injeksi, dan sistem pembakaran untuk akselerasi maksimal dan efisiensi bahan bakar.</p>
                    </div>
                    <!-- Service 3 -->
                    <div style="padding: 32px; background: #0f1115; border: 1px solid rgba(255,255,255,0.06); border-radius: 20px;">
                        <div style="width: 52px; height: 52px; background: rgba(168,85,247,0.1); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: #a78bfa; margin-bottom: 20px;">
                            <svg style="width:26px;height:26px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <h3 style="font-size: 1.1rem; font-weight: 700; color: #fff; margin-bottom: 10px;">Sistem Rem &amp; Kaki</h3>
                        <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.7;">Pemeriksaan rem komprehensif, ganti kampas, balancing, serta spooring untuk kenyamanan dan keamanan.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Keunggulan Section -->
        <section id="keunggulan" style="padding: 80px 24px; background: #0f1115;">
            <div style="max-width: 1100px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1fr; gap: 64px; align-items: center;">
                <!-- Left: Text -->
                <div>
                    <h2 style="font-size: 2rem; font-weight: 800; color: #fff; margin-bottom: 16px; line-height: 1.2;">Pengalaman Digital Sepenuhnya</h2>
                    <p style="color: #94a3b8; font-size: 0.95rem; line-height: 1.7; margin-bottom: 32px;">
                        Tinggalkan antrean yang membosankan dan transparansi harga yang buruk. Melalui sistem bengkel kami, semua dapat dilakukan melalui ponsel cerdas Anda.
                    </p>
                    <div style="display: flex; flex-direction: column; gap: 24px;">
                        <div style="display: flex; gap: 16px; align-items: flex-start;">
                            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(168,85,247,0.1); border: 1px solid rgba(168,85,247,0.2); display: flex; align-items: center; justify-content: center; color: #a78bfa; flex-shrink: 0;">
                                <svg style="width:20px;height:20px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h4 style="font-size: 1rem; font-weight: 700; color: #fff; margin-bottom: 4px;">Booking Mudah</h4>
                                <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6;">Pilih slot waktu sesuai ketersediaan jadwal Anda langsung dari aplikasi.</p>
                            </div>
                        </div>
                        <div style="display: flex; gap: 16px; align-items: flex-start;">
                            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(168,85,247,0.1); border: 1px solid rgba(168,85,247,0.2); display: flex; align-items: center; justify-content: center; color: #a78bfa; flex-shrink: 0;">
                                <svg style="width:20px;height:20px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            </div>
                            <div>
                                <h4 style="font-size: 1rem; font-weight: 700; color: #fff; margin-bottom: 4px;">Pantau Status Real-Time</h4>
                                <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6;">Lihat apakah mobil Anda sedang dikerjakan mekanik atau sudah selesai.</p>
                            </div>
                        </div>
                        <div style="display: flex; gap: 16px; align-items: flex-start;">
                            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(168,85,247,0.1); border: 1px solid rgba(168,85,247,0.2); display: flex; align-items: center; justify-content: center; color: #a78bfa; flex-shrink: 0;">
                                <svg style="width:20px;height:20px" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div>
                                <h4 style="font-size: 1rem; font-weight: 700; color: #fff; margin-bottom: 4px;">Invoice Digital &amp; Transparan</h4>
                                <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6;">Rincian sparepart, biaya perbaikan, dan riwayat disimpan rapi tanpa kertas.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Stats -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div style="padding: 28px 20px; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; text-align: center;">
                        <div style="font-size: 2.5rem; font-weight: 800; color: #fff; margin-bottom: 8px;">12K+</div>
                        <div style="font-size: 0.875rem; color: #94a3b8;">Mobil Terservis</div>
                    </div>
                    <div style="padding: 28px 20px; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; text-align: center; margin-top: 24px;">
                        <div style="font-size: 2.5rem; font-weight: 800; color: #a78bfa; margin-bottom: 8px;">99%</div>
                        <div style="font-size: 0.875rem; color: #94a3b8;">Kepuasan Pelanggan</div>
                    </div>
                    <div style="padding: 28px 20px; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; text-align: center;">
                        <div style="font-size: 2.5rem; font-weight: 800; color: #fff; margin-bottom: 8px;">30+</div>
                        <div style="font-size: 0.875rem; color: #94a3b8;">Mekanik Handal</div>
                    </div>
                    <div style="padding: 28px 20px; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; text-align: center; margin-top: 24px;">
                        <div style="font-size: 2.5rem; font-weight: 800; color: #fff; margin-bottom: 8px;">4.9</div>
                        <div style="font-size: 0.875rem; color: #94a3b8;">Rating Google</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimoni Section -->
        <section id="testimoni" style="padding: 80px 24px; background: #0a0b0e; border-top: 1px solid rgba(255,255,255,0.05);">
            <div style="max-width: 1100px; margin: 0 auto;">
                <div style="text-align: center; max-width: 600px; margin: 0 auto 56px;">
                    <h2 style="font-size: 2rem; font-weight: 800; color: #fff; margin-bottom: 12px;">Ulasan Pelanggan</h2>
                    <p style="color: #94a3b8; font-size: 0.95rem; line-height: 1.7;">Mereka yang telah merasakan pengalaman bebas antre dan transparansi biaya servis.</p>
                </div>

                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
                    <!-- Card 1 -->
                    <div style="padding: 28px; background: #0f1115; border: 1px solid rgba(255,255,255,0.06); border-radius: 20px; display: flex; flex-direction: column; justify-content: space-between; min-height: 220px;">
                        <div>
                            <div style="font-size: 2.5rem; color: #7c3aed; font-family: Georgia, serif; line-height: 1; margin-bottom: 12px;">&ldquo;</div>
                            <p style="color: #cbd5e1; font-size: 0.875rem; line-height: 1.7; margin-bottom: 20px;">
                                Proses masuk bengkel sangat mulus. Booking dari aplikasi semalam, pagi datang langsung ditangani. Sangat praktis!
                            </p>
                        </div>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 38px; height: 38px; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #fff;">R</div>
                            <div>
                                <div style="font-weight: 700; color: #fff; font-size: 0.9rem;">Reza H.</div>
                                <div style="font-size: 0.75rem; color: #64748b;">Honda CR-V</div>
                            </div>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div style="padding: 28px; background: #0f1115; border: 1px solid rgba(255,255,255,0.06); border-radius: 20px; display: flex; flex-direction: column; justify-content: space-between; min-height: 220px;">
                        <div>
                            <div style="font-size: 2.5rem; color: #7c3aed; font-family: Georgia, serif; line-height: 1; margin-bottom: 12px;">&ldquo;</div>
                            <p style="color: #cbd5e1; font-size: 0.875rem; line-height: 1.7; margin-bottom: 20px;">
                                Suka dengan fitur transparansi harganya. Mekanik selalu minta persetujuan di aplikasi sebelum mengganti sparepart.
                            </p>
                        </div>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 38px; height: 38px; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #fff;">A</div>
                            <div>
                                <div style="font-weight: 700; color: #fff; font-size: 0.9rem;">Anita P.</div>
                                <div style="font-size: 0.75rem; color: #64748b;">Toyota Yaris</div>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div style="padding: 28px; background: #0f1115; border: 1px solid rgba(255,255,255,0.06); border-radius: 20px; display: flex; flex-direction: column; justify-content: space-between; min-height: 220px;">
                        <div>
                            <div style="font-size: 2.5rem; color: #7c3aed; font-family: Georgia, serif; line-height: 1; margin-bottom: 12px;">&ldquo;</div>
                            <p style="color: #cbd5e1; font-size: 0.875rem; line-height: 1.7; margin-bottom: 20px;">
                                Invoice digitalnya bikin gampang klaim servis kantor. Tinggal unduh dari dashboard, rapi dan profesional.
                            </p>
                        </div>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 38px; height: 38px; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #fff;">B</div>
                            <div>
                                <div style="font-weight: 700; color: #fff; font-size: 0.9rem;">Budi K.</div>
                                <div style="font-size: 0.75rem; color: #64748b;">Mitsubishi Xpander</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section style="padding: 80px 24px; text-align: center; background: linear-gradient(to bottom, #0f1115, #1a0b2e, #0f1115); border-top: 1px solid rgba(255,255,255,0.05); border-bottom: 1px solid rgba(255,255,255,0.05);">
            <div style="max-width: 700px; margin: 0 auto;">
                <h2 style="font-size: 2.5rem; font-weight: 800; color: #fff; margin-bottom: 16px; line-height: 1.2;">Siap Untuk Servis Berikutnya?</h2>
                <p style="font-size: 1rem; color: #c4b5fd; margin-bottom: 36px; line-height: 1.7; opacity: 0.85;">
                    Bergabunglah dengan ribuan pemilik mobil lainnya yang telah merasakan mudahnya merawat kendaraan secara transparan dan efisien.
                </p>
                <a href="{{ route('register') }}" style="display: inline-block; padding: 14px 36px; background: #fff; color: #0f1115; font-weight: 700; font-size: 1rem; border-radius: 16px; text-decoration: none; transition: background 0.2s;">
                    Daftar Sekarang Secara Gratis
                </a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer style="background: #050507; border-top: 1px solid rgba(255,255,255,0.07); padding: 56px 24px 32px;">
        <div style="max-width: 1100px; margin: 0 auto;">

            <!-- Footer Top Grid -->
            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 40px; margin-bottom: 48px;">

                <!-- Brand -->
                <div>
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                        <div style="width: 36px; height: 36px; background: #7c3aed; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #fff; font-size: 13px;">WM</div>
                        <span style="font-size: 1.2rem; font-weight: 700; color: #fff;">webmobil</span>
                    </div>
                    <p style="font-size: 0.875rem; color: #94a3b8; line-height: 1.7; max-width: 300px;">
                        Transformasi pengalaman bengkel menjadi sepenuhnya digital. Lebih mudah, transparan, dan terpercaya.
                    </p>
                </div>

                <!-- Menu Cepat -->
                <div>
                    <h4 style="font-size: 0.875rem; font-weight: 700; color: #fff; margin-bottom: 16px; text-transform: uppercase; letter-spacing: 0.05em;">Menu Cepat</h4>
                    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px;">
                        <li><a href="#hero" style="color: #94a3b8; text-decoration: none; font-size: 0.875rem;">Beranda</a></li>
                        <li><a href="#layanan" style="color: #94a3b8; text-decoration: none; font-size: 0.875rem;">Layanan</a></li>
                        <li><a href="#keunggulan" style="color: #94a3b8; text-decoration: none; font-size: 0.875rem;">Keunggulan</a></li>
                        <li><a href="#testimoni" style="color: #94a3b8; text-decoration: none; font-size: 0.875rem;">Testimoni</a></li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div>
                    <h4 style="font-size: 0.875rem; font-weight: 700; color: #fff; margin-bottom: 16px; text-transform: uppercase; letter-spacing: 0.05em;">Kontak Kami</h4>
                    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px;">
                        <li style="color: #94a3b8; font-size: 0.875rem;">halo@webmobil.com</li>
                        <li style="color: #94a3b8; font-size: 0.875rem;">0812-3456-7890</li>
                        <li style="color: #94a3b8; font-size: 0.875rem;">Jl. Sudirman No. 123, Jakarta</li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div style="border-top: 1px solid rgba(255,255,255,0.07); padding-top: 24px; text-align: center;">
                <p style="color: #475569; font-size: 0.8rem;">© 2026 webmobil Bengkel Digital. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

</body>
</html>
